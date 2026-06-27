<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sisa_makanans', function (Blueprint $table) {
            $table->integer('snack_pagi')->nullable();
            $table->integer('snack_sore')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sisa_makanans', function (Blueprint $table) {
            $table->dropColumn(['snack_pagi', 'snack_sore']);
        });
    }
};
