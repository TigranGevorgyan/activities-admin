<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description');
            $table->foreignId('source_id')->nullable()->constrained('participants')->nullOnDelete();
            $table->json('media')->nullable();
            $table->string('short_description', 200)->nullable();
            $table->string('registration_url')->nullable();
            $table->string('location')->nullable();
            $table->json('coordinates')->nullable();
            $table->json('dates')->nullable();
            $table->foreignId('activity_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
