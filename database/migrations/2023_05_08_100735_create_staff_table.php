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
        Schema::create('staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->foreign()->constrained('users')->onDelete('set null');
            $table->string('code')->unique()->comment('merge user_id, position and generation');
            $table->string('position');
            $table->boolean('is_active')->default(true);
            $table->integer('generation');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->uuid('edited_by')->foreign()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
