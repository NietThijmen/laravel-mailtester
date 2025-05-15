<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_spam_assasin_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_spamassasin_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->float('points');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_spam_assasin_reports');
    }
};
