<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSymbolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->renameColumn('name', 'company')->change();
            $table->renameColumn('symbol', 'name')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('symbols', function (Blueprint $table) {
            $table->renameColumn('name', 'symbol')->change();
            $table->renameColumn('company', 'name')->change();
        });
    }
}
