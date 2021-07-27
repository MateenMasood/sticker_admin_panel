<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAminitiesAndDescriptionIntoRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->Integer('no_of_person')->nullable();
            $table->Integer('no_of_kids')->nullable();
            $table->string('room_size')->nullable();
            $table->string('bed_type')->nullable();
            $table->longText('description');
            $table->longText('aminities');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn([ 'no_of_person', 'no_of_kids' , 'room_size' , 'bed_type' , 'description' , 'aminities' ]);
        });
    }
}
