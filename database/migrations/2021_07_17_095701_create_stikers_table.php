<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStikersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stikers', function (Blueprint $table) {
            $table->id();
            $table->integer('category')->comment = 'Category';
            $table->string('title')->comment = 'Title';
            $table->string('tags')->comment = 'Tags';
            $table->integer('premium')->comment = 'Premium';
            $table->json('icons')->comment = 'Stiker Icons';
            $table->json('stikers')->comment = 'Stikers';
            $table->integer('views')->default(0)->views = 'Views';
            $table->integer('downloads')->default(0)->comment = 'Downloads';
            $table->enum('status',['0' , '1']);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('stikers');
    }
}
