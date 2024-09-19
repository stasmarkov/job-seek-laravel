<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Employer\Models\EmployerProfile;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('vacancies', function (Blueprint $table) {
      $table->id();
      $table->uuid();
      $table->foreignIdFor(EmployerProfile::class);
      $table->string('title')->index();
      $table->string('salary');
      $table->string('location');
      // Full-time/Part-time/Contract.
      $table->string('schedule')->default('Full Time');
      $table->string('url');
      $table->boolean('featured')->default(FALSE);
      $table->longText('description')->fulltext('description');
      $table->longText('short_description');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('vacancies');
  }

};
