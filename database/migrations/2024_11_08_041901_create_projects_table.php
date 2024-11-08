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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliate_id')->nullable();
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('set null');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('project_name');
            $table->string('project_type');
            $table->text('project_description');
            $table->decimal('total_value', 10, 2)->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
