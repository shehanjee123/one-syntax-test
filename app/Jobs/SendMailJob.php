<?php

namespace App\Jobs;

use \Exception;
use App\Mail\SubcriptionMail;
use App\Models\SubcriptionUser;
use App\Models\Subscription;
use App\Models\WebsitePost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id;
    public $websitePost;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id, WebsitePost $websitePost){
        $this->user_id = $user_id;
        $this->websitePost = $websitePost;
    }

    /**
     * Execute the job.
     */
    public function handle(){
        try {

            $user = SubcriptionUser::find($this->user_id);

            if (!$user) {
                Log::warning("Subscription user not found", ['user_id' => $this->user_id]);
                return;
            }

            // Log before sending email
            Log::info("Sending email to subscriber", [
                'email' => $user->email,
                'post_title' => $this->websitePost->post_title,
                'post_description' => $this->websitePost->post_description,
            ]);

            Mail::to($user->email)->send(new SubcriptionMail($this->websitePost));

            // Log after successful email sending
            Log::info("Email sent successfully", [
                'email' => $user->email,
                'post_title' => $this->websitePost->post_title,
                'post_description' => $this->websitePost->post_description,
            ]);

        } catch (Exception $e) {
            Log::error("Failed to send email", [
                'user_id' => $this->user_id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
