<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;
use App\Services\TicketClassifier;

class ClassifyTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Apply middleware to the job.
     */
    public function middleware(): array
    {
        return [new RateLimited('ticket-classifier')];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $classification = TicketClassifier::classify(
                $this->ticket->subject,
                $this->ticket->body
            );
        } catch (\Exception $e) {
            $categories = ['Support', 'Bug', 'Feature Request', 'General'];
            $randomCategory = $categories[array_rand($categories)];
            $classification = [
                'category' => $randomCategory,
                'explanation' => 'This is a test explanation',
                'confidence' => 0,
            ];
        }

        if (!empty($this->ticket->category)) {
            unset($classification['category']);
        }

        $this->ticket->update($classification);
    }
}
