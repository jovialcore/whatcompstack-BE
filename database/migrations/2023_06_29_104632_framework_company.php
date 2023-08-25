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
        Schema::create('framework_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('framework_id');
            $table->unsignedBigInteger('company_id'); //should incase we revert to using uuids
            $table->integer('rating')->default('0');
            $table->integer('draft_rating')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('framework_company');
    }
};
