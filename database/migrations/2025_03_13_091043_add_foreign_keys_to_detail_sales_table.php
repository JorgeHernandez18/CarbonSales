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
        Schema::table('detail_sales', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->constrained();
            $table->foreignId('shipper_id')->nullable()->constrained();
            $table->foreignId('material_id')->nullable()->constrained();
            $table->foreignId('type_id')->nullable()->constrained();
            $table->foreignId('size_id')->nullable()->constrained();
            $table->unsignedBigInteger('destination_country_id')->nullable();
            $table->foreign('destination_country_id')->references('id')->on('destination_countries');
            $table->unsignedBigInteger('sale_state_id')->nullable();
            $table->foreign('sale_state_id')->references('id')->on('sale_states');
            $table->foreignId('lab_id')->nullable()->constrained();
            $table->foreignId('agency_id')->nullable()->constrained();
            $table->unsignedBigInteger('second_state_id')->nullable();
            $table->foreign('second_state_id')->references('id')->on('second_states');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_sales', function (Blueprint $table) {
            //
        });
    }
};
