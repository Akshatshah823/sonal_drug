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
        Schema::create('admin_menu', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('page_name');
        $table->foreignId('parent_id')->nullable()->constrained('admin_menu')->onDelete('cascade');
        $table->tinyInteger('status')->default(1);
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_menu');
    }
};
