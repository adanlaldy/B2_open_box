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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('from_user_id');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('cc_user_id')->nullable();
            $table->foreign('cc_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('bcc_user_id')->nullable();
            $table->foreign('bcc_user_id')->references('id')->on('users');
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('sent_at');
            $table->boolean('starred');
            $table->boolean('archived');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
