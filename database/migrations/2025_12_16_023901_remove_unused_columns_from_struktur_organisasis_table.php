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
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $table->dropColumn(['nama', 'jabatan', 'foto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('foto')->nullable();
        });
    }
};
