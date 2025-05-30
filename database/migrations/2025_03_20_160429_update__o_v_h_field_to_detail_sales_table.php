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
            $table->dropColumn('OVH');
            $table->integer('OVH')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_sales', function (Blueprint $table) {
            $table->dropColumn('OVH');
            $table->integer('OVH')->default(0);
        });
    }
};
