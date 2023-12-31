<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailConfig;
    /**
     * Create a new job instance.
     */
    public function __construct(array $emailConfig)
    {
        $this->emailConfig = $emailConfig;
    }

    public function handle(): void
    {
        $to = $this->emailDetails['to'];
        $subject = $this->emailDetails['subject'];
        $body = $this->emailDetails['body'];

        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
    }
}
