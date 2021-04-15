<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostMethodValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_method_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cost_method_calculation_id');
            $table->foreign('cost_method_calculation_id', 'cost_method_calculation_id_values_fk')
                ->references('id')
                ->on('cost_method_calculations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('key');
            $table->decimal('value');

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
        Schema::dropIfExists('cost_method_values');
    }
}
