<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment = 'title';
            $table->string('identifier')->comment = 'identifier';
            $table->string('publisher')->comment= 'Publisher';
            $table->string('publisher_website')->nullable()->comment= 'Publisher Website';
            $table->string('privacy_policy_website')->nullable()->comment= 'Privacy Policy Website';
            $table->string('license_agreement_website')->nullable()->comment= 'License Agreement Website';
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
        Schema::dropIfExists('packs');
    }
}
