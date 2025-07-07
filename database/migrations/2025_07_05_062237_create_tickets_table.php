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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('subject');
            $table->text('body');
            $table->text('explanation')->nullable();
            $table->decimal('confidence', 10, 2)->default(0);
            $table->string('category')->nullable();
            $table->string('note')->nullable();
            $table->enum('status', ['open', 'in_progress', 'closed', 'resolved'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
