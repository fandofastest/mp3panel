<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('artist_id');
            $table->string('genre_id');
            $table->string('cover');
            $table->string('year');
            $table->text('deskripsi');
<<<<<<< HEAD
            $table->string('year');
=======
            $table->biginteger('plays')->default(0);
>>>>>>> ca521347865964bd708db7aa1401a278642dc226
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
        Schema::dropIfExists('albums');
    }
}
