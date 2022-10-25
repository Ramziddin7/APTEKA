<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductJoinInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_join_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('series');
            $table->date('deadline');
            $table->integer('amount');
            $table->bigInteger('base_price')->nullable();
            $table->integer('base_price_percent')->nullable();
            $table->integer('trade_discount')->nullable();  //targoviy skidka 100 ta olsa 1 ta bonus joyi uchun
            $table->bigInteger('delivery_cost')->nullable(); // stoimost postavki
            $table->integer('vat')->nullable();  // НДС
            $table->string('certificate')->nullable();
            $table->bigInteger('price');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('product_join_invoices');
    }
}