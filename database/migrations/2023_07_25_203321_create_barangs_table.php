<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            // $table->id();
            $table->char('FK_BRG', 5)->primary();
            $table->string('FN_BRG');
            $table->char('FK_JENIS', 5);
            $table->char('FK_SAT', 5);
            $table->double('FHARGA_HNA')->default(0);
            $table->double('FHARGA_JUAL')->default(0);
            $table->double('FPROFIT')->default(0);
            $table->double('FSALDO')->default(0);
            $table->double('FIN')->default(0);
            $table->double('FOUT')->default(0);
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
        Schema::dropIfExists('barangs');
    }
}
