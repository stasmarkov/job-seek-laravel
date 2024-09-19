<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Candidate\Models\CandidateProfile;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('contact_information', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(CandidateProfile::class);
      $table->string('email');
      $table->string('telegram')->nullable();
      $table->string('whatsapp')->nullable();
      $table->string('skype')->nullable();
      $table->string('phone')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('contact_information');
  }

};
