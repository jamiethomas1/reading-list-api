<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title"); // Throw error in API response if null
            $table->json("authors_array")->default(new Expression('(JSON_ARRAY())'));
            $table->date("published")->nullable(); // Check in API logic if null, return empty date string
            $table->json("genres_array")->default(new Expression('(JSON_ARRAY())'));
            $table->unsignedSmallInteger("length_pages"); // Throw error in API response if null
            $table->boolean("complete")->nullable()->default(false); // When set to true, also set finished_reading to current timestamp
            $table->unsignedSmallInteger("current_page")->nullable()->default(0);
            $table->string("current_chapter")->nullable()->default("");
            $table->date("started_reading")->nullable(); // Check in API logic if null, return empty date string
            $table->date("finished_reading")->nullable(); // Check in API logic if null, return empty date string
            $table->string("cover_image_url")->nullable(); // Return null, make clear in docs that developer should provide default image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
