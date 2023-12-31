<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBatchEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $campaignId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $campaign = Campaign::find($this->campaignId);

        if (!$campaign) {
            return;
        }

        foreach ($campaign->recipients as $recipient) {
            $emailDetails = [
                'to' => $recipient,
                'body' => $campaign->content,
                'subject' => $campaign->subject,
            ];
            SendEmailJob::dispatch($emailDetails);
        }
    }
}
