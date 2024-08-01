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
        Schema::table('books', function (Blueprint $table) {
            // Drop all existing columns
            $table->dropColumn(['created_at', 'updated_at', 'title', 'author', 'price', 'stock']);

            // Add new columns
            $table->string('title');
            $table->string('author');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->timestamps();  // created_at and updated_at 
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
