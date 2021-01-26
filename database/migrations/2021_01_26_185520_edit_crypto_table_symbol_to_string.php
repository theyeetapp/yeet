<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditCryptoTableSymbolToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto', function (Blueprint $table) {
            $table->string('symbol', 20)->change();
            $table->string('name', 150)->after('symbol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crypto', function (Blueprint $table) {
            $table->char('symbol', 3)->unique()->change();
            $table->dropColumn('name');
        });
    }
}
