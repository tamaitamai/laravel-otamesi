<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_goods', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('review_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_goods');
    }
};
