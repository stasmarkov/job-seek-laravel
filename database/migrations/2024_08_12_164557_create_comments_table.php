<?php

use App\Models\BlogPost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Auth\Models\User;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('comments', function(Blueprint $table) {
      $table->id();
      $table->foreignIdFor(BlogPost::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
      $table->text('body');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('comments');
  }

};
