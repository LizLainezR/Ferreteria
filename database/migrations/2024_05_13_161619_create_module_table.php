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
        Schema::create('module', function (Blueprint $table) {
            $table->id('id_module',);
            $table->string('description');
            $table->boolean('status');
            $table->timestamps();
        });
    
        Schema::create('submodule',function(Blueprint $table){
            $table->id('id_submodule');
            $table->string('description');
            $table->string('url'); 
            $table->unsignedBigInteger('id_module');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('id_module')->references('id_module')->on('module');
        });


        
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module');
        Schema::dropIfExists('submodule');
    }
};
