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
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained();
            $table->date('year')->nullable();
            $table->string('ops')->nullable();
            $table->string('inconterms')->nullable();
            $table->string('third')->nullable();
            $table->string('buque')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->date('ETA')->nullable();
            $table->string('port')->nullable();
            $table->date('BL')->nullable();
            $table->double('tm')->nullable();
            $table->string('discharge_port')->nullable();
            $table->double('load_rate')->nullable();
            $table->integer('OVH')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sales');
    }
};
