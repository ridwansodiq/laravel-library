<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
    * The name of the database connection to use.
    *
    * @var string
    */
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::connection($this->connection)
        ->table('users', function (Blueprint $collection) 
        {
            $collection->increments('id');
            $collection->index('name');
            $collection->unique('email');
            $collection->index('password');
            $collection->rememberToken();
            $collection->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)
        ->table('users', function (Blueprint $collection) 
        {
            $collection->drop();
        });
    }
}
