<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOAuthSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth_sessions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->enum('owner_type', array('client', 'user'))->default('user');
            $table->string('owner_id');
            $table->timestamps();

            $table->index(array('client_id', 'owner_type', 'owner_id'));

            $table->foreign('client_id')
                    ->references('id')->on('oauth_clients')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('oauth_sessions');
	}

}