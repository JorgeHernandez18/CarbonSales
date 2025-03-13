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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_sale_id');
            $table->foreign('detail_sale_id')->references('id')->on('detail_sales');
            $table->foreignId('user_id')->constrained();
            $table->string('modified_field');
            $table->string('old_value');
            $table->string('new_value');
            $table->string('modified_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
