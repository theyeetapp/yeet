<?php

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditStocksTableSymbolToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
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
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }

        // Schema::table('stocks', function (Blueprint $table) {
        //     // $table->char('symbol', 20)->change();
        //     $table->dropColumn(['name']);
        // });
    }
}
