<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('nome_negozio');
            $table->float('credito', '4', '2')->default(40);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('products', function(Blueprint $table) {
            $table->unsignedBigInteger("seller_id")
                ->nullable()
                ->after('id');
            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
