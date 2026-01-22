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
        Schema::table('custom_menus', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['parent_id']);
            
            // Recreate parent_id as nullable without foreign key constraint
            // This allows parent_id to reference either menus table or custom_menus table
            // We'll handle the relationship logic in the application layer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_menus', function (Blueprint $table) {
            // Re-add the old foreign key constraint
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('custom_menus')
                  ->onDelete('cascade');
        });
    }
};
