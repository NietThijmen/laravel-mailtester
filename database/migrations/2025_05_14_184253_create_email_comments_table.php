<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_comments', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('email_id')->constrained('emails')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_comments');
    }
};
