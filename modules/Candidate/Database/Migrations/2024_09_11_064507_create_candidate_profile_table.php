<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('candidate_profiles', function (Blueprint $table) {
      $table->id();
      $table->string('first_name');
      $table->string('last_name');
      $table->longText('description');
      $table->longText('achievements')->nullable();
      $table->string('experience_since');
      $table->foreignIdFor(User::class);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('candidate_profiles');
  }

};
