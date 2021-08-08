<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('leads', function (Blueprint $table) {
      $table->id();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->boolean('wni')->nullable();
      $table->boolean('has_bca')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('leads');
  }
}
