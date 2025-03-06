<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('website_posts')->onDelete('cascade');
            $table->unsignedTinyInteger('user_id');
            $table->timestamps();

            $table->unique(['post_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_subscriptions');
    }
};
