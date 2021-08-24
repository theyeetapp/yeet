<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCryptoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('crypto', function (Blueprint $table) {
         $table->dropUnique(['symbol']);
     });

      Schema::rename('crypto', 'symbols');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::rename('symbols', 'crypto');

       Schema::table('crypto', function (Blueprint $table) {
         $table->string('symbol')->unique()->change();
     });
    }
}
