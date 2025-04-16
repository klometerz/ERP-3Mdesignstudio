<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPekerjaanAndFotoToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('nama_pekerjaan')->nullable();
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['nama_pekerjaan', 'foto_before', 'foto_after']);
        });
    }
}
