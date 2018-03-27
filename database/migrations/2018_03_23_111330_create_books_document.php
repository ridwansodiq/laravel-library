<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)
        ->table('book_list', function (Blueprint $collection) 
        {
            $collection->index('isbn');
            $collection->unique('title');
            $collection->index('author');
            $collection->index('description');
            $collection->index('book_cover');
            $collection->index('published_year');
            $collection->index('publisher');
            $collection->index('book_category');
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
        ->table('book_list', function (Blueprint $collection) 
        {
            $collection->drop();
        });
    }
}
