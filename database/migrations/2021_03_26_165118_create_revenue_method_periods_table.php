<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueMethodPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_method_periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('revenue_method_calculation_id');
            $table->foreign('revenue_method_calculation_id', 'revenue_method_calculation_id_periods_fk')
                ->references('id')
                ->on('revenue_method_calculations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('index');
            $table->decimal('sales_volume');
            $table->decimal('expected_price');
            $table->decimal('expected_cost');
            $table->decimal('licensor_percentage');

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
        Schema::dropIfExists('revenue_method_periods');
    }
}
