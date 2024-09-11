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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('type');
            $table->decimal('price', 15, 2);
            $table->string('details');
            $table->string('garage');
            $table->string('section');
            $table->string('property');
            $table->string('balcony');
            $table->string('furniture');
            $table->string('status');
            $table->date('lock_date');
            $table->integer('months');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('user_id');


            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('user_id')->references('id')->on('users');
            // ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
