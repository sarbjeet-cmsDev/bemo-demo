<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ClassifyTicket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource with filters, search, and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $tickets = $query->paginate($perPage);

        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'category' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);

        return response()->json($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'status' => ['nullable', Rule::in(['open', 'in_progress', 'closed', 'resolved'])],
            'category' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $ticket->update($validated);

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully']);
    }

    /**
     * Classify ticket using AI (dispatch queued job).
     */
    public function classify(string $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);

        ClassifyTicket::dispatch($ticket);

        return response()->json([
            'message' => 'Ticket classification job dispatched successfully',
            'ticket_id' => $ticket->id
        ]);
    }

    /**
     * Get statistics for dashboard charts.
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total_tickets' => Ticket::count(),
            'tickets_by_status' => Ticket::select('status', DB::raw('count(*) as total'))
                                          ->groupBy('status')
                                          ->get()
                                          ->toArray('total', 'status'),
            'tickets_by_category' => Ticket::select('category', DB::raw('count(*) as total'))
                                            ->groupBy('category')
                                            ->get()
                                            ->toArray('total', 'category'),
        ];
        return response()->json($stats);
    }

    /**
     * Export tickets to CSV with search query.
     */
    public function exportCsv(Request $request): JsonResponse
    {
        // Fetch tickets based on search query
        $query = Ticket::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }


        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $tickets = $query->get();

        // Generate CSV content
        $csvContent = "Subject,Category,Status\n";
        foreach ($tickets as $ticket) {
            $csvContent .= "\"{$ticket->subject}\",\"{$ticket->category}\",\"{$ticket->status}\"\n";
        }

        // Save the CSV content to a storage disk
        $fileName = 'tickets_' . time() . '.csv';
        Storage::disk('public')->put($fileName, $csvContent);

        // Generate a download URL for the CSV file
        $uniqueUrl = Storage::disk('public')->url($fileName);

        return response()->json([
            'message' => 'CSV export generated successfully',
            'download_url' => $uniqueUrl
        ]);
    }
}
