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
        Schema::create('contact_books', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name');
            $table->string('contact_phone', 11);
            $table->string('contact_email', 155);
            $table->string('address',255);
            $table->string('number');
            $table->string('neighborhood');
            $table->string('city',32);
            $table->string('state',20);
            $table->char('postal_code',8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_books');
    }
};
