<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock', function (Blueprint $table) {
            $table->text('stock_type');
            $table->text('batch_no')->nullable();
            $table->text('lot_no')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->integer('retreatment_interval')->nullable();
            $table->integer('meat_whp')->nullable();
            $table->integer('milk_whp')->nullable();
            $table->integer('esi_whp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock', function (Blueprint $table) {
          $table->dropColumn('stock_type');
          $table->dropColumn('batch_no');
          $table->dropColumn('lot_no');
          $table->dropColumn('expiry_date');
          $table->dropColumn('retreatment_interval');
          $table->dropColumn('meat_whp');
          $table->dropColumn('milk_whp');
          $table->dropColumn('esi_whp');

        });
    }
}
