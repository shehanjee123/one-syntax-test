<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSitePostRequest;
use App\Http\Requests\WebsiteRequest;
use App\Jobs\SendMailJob;
use App\Models\PostSubscription;
use App\Models\Subscription;
use App\Models\Website;
use App\Models\WebsitePost;
use Illuminate\Http\Request;

class WebsiteController extends Controller {

    // post upload form loading function
    public function index()
    {
        $websites = Website::all();
        return view('frontend.postUpoadForm', compact('websites'));
    }

    // This is the Post Upload Function
    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'post_title' => 'required|string|max:255',
            'post_description' => 'required|string',
        ]);

        $websitePost = WebsitePost::create([
            'post_title' => $request->post_title,
            'post_description' => $request->post_description,
            'website_id' => $request->website_id,
            'is_publish' => $request->is_publish
        ]);

        $subscribers = Subscription::where('website_id', $request->website_id)->pluck('user_id');

        if ($subscribers->isNotEmpty()) {
            foreach ($subscribers as $user_id) {
                // Check if the post has already sent to this subscriber
                $alreadySent = PostSubscription::where('post_id', $websitePost->id)
                    ->where('user_id', $user_id)
                    ->exists();

                if (!$alreadySent) {
                    // Record that this post is sent to this user
                    $postupload = PostSubscription::create([
                        'post_id' => $websitePost->id,
                        'user_id' => $user_id
                    ]);

                    if($postupload){
                        SendMailJob::dispatch($user_id, $websitePost);
                    }
                }
            }
        }

        return response()->json(['message' => 'Post created and emails sent to subscribers.'], 200);
    }


    // using this to send mail
    public function showPost($id){
        $post = WebsitePost::findOrFail($id);
        return view('frontend.emails.subscription', compact('post'));
    }

    // Post showing functions
    public function showOldPost(){
        $oldPosts = WebsitePost::all();
        return view('frontend.oldPost', compact('oldPosts'));
    }

    // Emails resent to users who did not receive
    public function sendMailFn(Request $request){
        $request->validate([
            'post_id' => 'required',
        ]);

        $postId = $request->post_id;
        $websitePost = WebsitePost::find($postId);

        if (!$websitePost) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $subscribers = Subscription::where('website_id', $websitePost->website_id)->pluck('user_id');

        if ($subscribers->isNotEmpty()) {
            foreach ($subscribers as $user_id) {
                $alreadySent = PostSubscription::where('post_id', $postId)->where('user_id', $user_id)->exists();

                if (!$alreadySent) {
                    $postupload = PostSubscription::create([
                        'post_id' => $postId,
                        'user_id' => $user_id
                    ]);

                    if ($postupload) {
                        SendMailJob::dispatch($user_id, $websitePost);
                    }
                }
            }
        }
        return response()->json(['message' => 'Emails resent to users who did not receive them previously.'], 200);
    }
}
