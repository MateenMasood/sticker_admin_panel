<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Application;


class CreateSettingsTable extends Migration
{
    public function __construct()
	{
		if (version_compare(Application::VERSION, '5.0', '>=')) {
			$this->tablename = Config::get('settings.table');
		} else {
			$this->tablename = Config::get('anlutro/l4-settings::table');
		}
	}

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->index();
			$table->text('value')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
