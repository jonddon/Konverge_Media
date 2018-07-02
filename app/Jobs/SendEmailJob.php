<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class SendEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data)
    {
        Mail::send('emails.haptics', $data, function($message) use ($data){
            $pdf = PDF::loadView('emails.pdf', $data)->setPaper('a4', 'landscape');
            $message->to($data['email'], $data['name'])->subject('Google Digital Skills For Africa Certificate');
            $message->attachData($pdf->output(), "GoogleDigitalSkillsCertificate.pdf");
        });
    }
}
