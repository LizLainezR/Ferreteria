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
        Schema::create('permissions', function (Blueprint $table) {
                $table->id('id_per');
                $table->string('Description');
                $table->unsignedBigInteger('id_role');
                $table->unsignedBigInteger('id_submodule');
                $table->timestamps();
                $table->foreign('id_submodule')->references('id_submodule')->on('submodule');
                $table->foreign('id_role')->references('id_role')->on('role');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
