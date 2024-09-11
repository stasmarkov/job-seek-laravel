<?php

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('taggables', function(Blueprint $table) {
      $table->id();

      $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
      $table->unsignedBigInteger('taggable_id');
      $table->string('taggable_type');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('taggables');
  }

};
