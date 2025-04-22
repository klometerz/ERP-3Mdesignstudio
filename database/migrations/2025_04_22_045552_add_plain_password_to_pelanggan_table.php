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
                Schema::table('pelanggan', function (Blueprint $table) {
                    $table->string('plain_password')->nullable()->after('status_pelanggan');
                });
            }

            public function down(): void
            {
                Schema::table('pelanggan', function (Blueprint $table) {
                    $table->dropColumn('plain_password');
                });
            }

};
