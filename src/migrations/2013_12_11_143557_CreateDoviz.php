<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoviz extends Migration {

   const TABLE = 'doviz';

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('doviz', function (Blueprint $table) {
         $table->increments('id');
         $table->date('tarih')->index();
         $table->decimal('dolar', 10, 6);
         $table->decimal('euro', 10, 6);
         $table->decimal('parite', 10, 6);
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
      Schema::drop(self::TABLE);
   }

}
