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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reserve_code')->unique();
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('guest_count');
            $table->enum('status',['pending','confirmed','cancelled','completed'])->default('pending');
            $table->enum('payment_status',['unpaid','paid'])->default('unpaid');
            $table->integer('total_price')->default(0);

            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
