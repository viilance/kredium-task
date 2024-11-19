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
        Schema::create('home_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->unique();
            $table->unsignedBigInteger('adviser_id');
            $table->decimal('property_value', 15);
            $table->decimal('down_payment', 15);
            $table->timestamps();

            // FK
            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('cascade');

            $table->foreign('adviser_id')
                ->references('id')->on('advisers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_loans');
    }
};
