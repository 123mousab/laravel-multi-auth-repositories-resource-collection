<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable($value = true);
            $table->integer('parent_id')->nullable($value = true);
            $table->string('key', 191)->collation('utf8mb4_unicode_ci');
            $table->json('name')->nullable($value = true);;
            $table->json('value')->nullable($value = true);;
            $table->enum('is_active', [1=>'active', 0=>'not_active'])->nullable($value = false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constants');
    }
}
