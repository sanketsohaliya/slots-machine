<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('timezone'); //all dates are compared to this timezone
            $table->string('name');
            $table->string('slug');
            $table->text('symbols');
            $table->text('weights');
            $table->timestamp('starts_at')->nullable(); //campaign can be used (games played on it) from this date onwards
            $table->timestamp('ends_at')->nullable(); //campaign can be used until this date
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
        Schema::dropIfExists('campaigns');
    }
};
