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
        Schema::create('learning_videos', function (Blueprint $table) {
            $table->id();
            $table->text("thumbnail");
            $table->text("title");
            $table->text("sub_title");
            $table->text("link");
            $table->boolean("isYoutube");
            $table->boolean("status")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_videos');
    }
};
