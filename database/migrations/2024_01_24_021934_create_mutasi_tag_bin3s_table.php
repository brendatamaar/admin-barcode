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
        Schema::create('mutasi_tag_bin3s', function (Blueprint $table) {
            $table->id();
            $table->string('site_id');
            $table->text('site_name');
            $table->string('tag_bin_location');
            $table->text('area');
            $table->string('zone');
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_tag_bin3s');
    }
};
