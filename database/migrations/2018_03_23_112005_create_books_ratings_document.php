<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksRatingsDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)
        ->table('book_ratings', function (Blueprint $collection) 
        {
            $collection->index('book_id');
            $collection->index('user_id');
            $collection->index('ratings');
            $collection->index('review');
            $collection->index('status');
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
        ->table('book_ratings', function (Blueprint $collection) 
        {
            $collection->drop();
        });
    }
}
