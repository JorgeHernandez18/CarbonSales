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
            $table->foreignId('ops_id')->nullable()->constrained();
            $table->unsignedBigInteger('inconterm_id')->nullable();
            $table->foreign('inconterm_id')->references('id')->on('inconterms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_sales', function (Blueprint $table) {
            $table->dropForeign(['ops_id']);
            $table->dropForeign(['inconterm_id']);
        });
    }
};
