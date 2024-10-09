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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('field')->nullable();
            $table->bigInteger('fileable_id')->nullable();
            $table->string('fileable_type')->nullable();
            $table->string('path');
            $table->string('filename');
            $table->string('extension', 10);
            $table->string('content_type', 20);
            $table->bigInteger('byte_size');
            $table->timestamps();

            $table->unique([
                'fileable_type',
                'fileable_id',
                'field',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
