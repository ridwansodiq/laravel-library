<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
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
        ->table('password_resets', function (Blueprint $collection) 
        {
            $collection->index('email');
            $collection->index('token');
            $collection->timestamp('created_at')->nullable();
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
        ->table('password_resets', function (Blueprint $collection) 
        {
            $collection->drop();
        });
        
    }
}
