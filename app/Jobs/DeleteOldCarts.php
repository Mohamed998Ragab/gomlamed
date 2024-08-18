<?php

namespace App\Jobs;

use App\Models\Cart;
use Carbon\Carbon as Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteOldCarts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Calculate the date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Delete carts older than 7 days
        Cart::where('created_at', '<', $sevenDaysAgo)->delete();
    }
}
