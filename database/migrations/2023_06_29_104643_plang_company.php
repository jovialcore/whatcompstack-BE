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
        Schema::create('plang_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plang_id');
            $table->unsignedBigInteger('company_id');
            $table->integer('rating')->default('0');
            $table->integer('draft_rating')->nullable();
            $table->integer('is_draft');
            $table->integer('is_published');
            $table->timestamps();

            // $table->foreign('plang_id')->references('id')->on('plangs')->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
