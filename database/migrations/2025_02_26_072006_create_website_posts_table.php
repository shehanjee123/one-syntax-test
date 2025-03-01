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
        Schema::create('website_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->string('post_description');
            $table->tinyInteger('website_id');
            $table->enum('is_publish',[0,1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_posts');
    }
};
