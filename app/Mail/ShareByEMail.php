<?php

namespace App\Mail;

use App\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareByEMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $job;
    public function __construct($request)
    {
        $this->data = $request;
        $this->job = Job::find($request->job_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('email_address'), get_option('site_name'))
            ->to($this->data->receiver_email, $this->data->receiver_name)
            ->subject($this->data->your_name.' Shared a job post with you')
            ->markdown('emails.share_by_email');
    }
}
