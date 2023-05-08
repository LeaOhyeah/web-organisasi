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
        Schema::create('news', function (Blueprint $table) {
            $table->unique(['title', 'uploaded_by']); // unique child constraints(users)
            $table->uuid('id')->primary();
            $table->uuid('uploaded_by')->foreign()->constrained('users')->onDelete('set null');
            $table->uuid('category_id')->foreign()->constrained('categories')->onDelete('set null');
            $table->string('title');
            $table->text('body');
            $table->string('image')->nullable();
            $table->text('hastag')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
