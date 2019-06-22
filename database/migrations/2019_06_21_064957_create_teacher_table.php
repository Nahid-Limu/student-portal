<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cms_id',30);
            $table->string('name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->string('educational_status')->nullable();
            $table->string('university')->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('created_by')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('teacher');
    }
}
