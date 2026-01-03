<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpKernel\Log\Logger;

class TranslateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Public Job $jobListing)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Logger('Translating '. $this->jobListing->title . ' to Spanish');
    }
}
