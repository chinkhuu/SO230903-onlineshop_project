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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending','confirmed','delivered','declined'])->default('pending');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('district');
            $table->string('khoroo')->nullable();
            $table->mediumText('address');
            $table->enum('payment_method', ['transfer', 'bank', 'cash', 'card'])->default('transfer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
