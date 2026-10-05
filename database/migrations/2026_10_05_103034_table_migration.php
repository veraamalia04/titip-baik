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
        Schema::create('donation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            
            $table->timestamps();
        });
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('no_ref')->unique();
            $table->string('donature_name');
            $table->string('donature_phone');
            $table->string('donature_email')->nullable();
            $table->string('donature_address')->nullable();

            $table->foreignId('operator_id')->constrained('users');
            $table->foreignId('category_id')->constrained('donation_categories')->nullable();
            $table->enum('status', ['draft', 'diterima', 'dikirim', 'disalurkan'])->default('draft');
            $table->timestamps();
        });

        Schema::create('donation_goods', function (Blueprint $table) {
            $table->id();
            $table->string('goods_name');
            $table->unsignedInteger('amount');
            $table->string('donated_to')->nullable();
            $table->string('donated_proof')->nullable();
            $table->timestamp('diterima_pada')->nullable();
            $table->timestamp('dikirim_pada')->nullable();
            $table->timestamp('disalurkan_pada')->nullable();
           
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
