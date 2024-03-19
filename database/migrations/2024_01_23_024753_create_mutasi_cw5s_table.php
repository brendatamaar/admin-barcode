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
        Schema::create('mutasi_cw5s', function (Blueprint $table) {
            $table->id();
            $table->string('site_id')->nullable();
            $table->text('site_name')->nullable();
            $table->text('location')->nullable();
            $table->string('location_type')->nullable();
            $table->text('category')->nullable();
            $table->string('item_no')->nullable();
            $table->text('item_name')->nullable();
            $table->text('barcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_cw5s');
    }
};
