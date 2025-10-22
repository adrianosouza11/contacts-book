<?php

namespace App\Jobs;

use App\Mail\NewContactRegisteredMail;
use App\Models\ContactBook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBackEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ContactBook $contactBook) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to(env('NOTIFICATION_MAIL'))->send(new NewContactRegisteredMail($this->contactBook));
    }
}
