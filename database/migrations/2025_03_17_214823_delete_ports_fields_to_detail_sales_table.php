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
            $table->dropColumn(['port','discharge_port']);
            $table->foreignId('port_id')->nullable()->constrained();
            $table->unsignedBigInteger('discharge_port_id')->nullable();
            $table->foreign('discharge_port_id')->references('id')->on('discharge_ports');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_sales', function (Blueprint $table) {
            $table->dropForeign(['port_id']);
            $table->dropForeign(['discharge_port_id']);
            $table->string('port')->nullable();
            $table->string('discharge_port')->nullable();
        });
    }
};
