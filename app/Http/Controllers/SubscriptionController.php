<?php

namespace App\Http\Controllers;

use App\Models\SubcriptionUser;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $websiteId = $request->get('website_id');
            $email = $request->get('email');

            $request->validate([
                'website_id' => 'required|exists:websites,id',
                'email' => 'required|email'
            ]);

            // Find or create user by email
            $user = SubcriptionUser::firstOrCreate(['email' => $request->email]);

            // Check if the user is already subscribed
            if (Subscription::where('user_id', $user->id)->where('website_id', $request->website_id)->exists()) {
                return response()->json(['message' => 'You are already subscribed.'], 400);
            }

            Subscription::create([
                'user_id' => $user->id,
                'website_id' => $request->website_id
            ]);

            return response()->json(['message' => 'Subscription successful.'], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
