<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stock_id');
            $table-> integer('volume');
            $table-> addColumn('decimal', 'purchased_price', ['default' => 0, 'total' => 8, 'places' => 2]);
            $table-> addColumn('decimal', 'moneypaid', ['default' => 0, 'total' => 8, 'places' => 2]);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('clients');
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}
