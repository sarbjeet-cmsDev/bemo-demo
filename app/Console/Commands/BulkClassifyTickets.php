<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;
use App\Jobs\ClassifyTicket;
use Illuminate\Support\Facades\RateLimiter;

class BulkClassifyTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:bulk-classify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bulk classify tickets where explanation is null';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch tickets where explanation is null
        $tickets = Ticket::whereNull('explanation')->get();

        foreach ($tickets as $ticket) {
            ClassifyTicket::dispatch($ticket);
        }

        $this->info('All tickets have been processed.');
    }
}
