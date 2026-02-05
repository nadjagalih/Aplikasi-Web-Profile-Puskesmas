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
        Schema::create('custom_menus', function (Blueprint $table) {
            $table->id();
            $table->string('parent_slug')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('custom_menus')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('url')->nullable();
            $table->string('type')->default('internal'); // internal, external, dropdown
            $table->string('target')->default('_self'); // _self, _blank
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_menus');
    }
};
