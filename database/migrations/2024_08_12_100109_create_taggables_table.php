<?php

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
      // Create the taggable_type and taggable_id columns.
      $table->morphs('taggable');
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
