
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('pagos', function(BluePrint $table){
            $table->id();
            
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            
            
            $table->unsignedBigInteger('concepto_id');
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onDelete('cascade');
            
            $table->unsignedBigInteger('recibo_id');
            $table->foreign('recibo_id')->references('id')->on('recibos')->onDelete('cascade');
            
            $table->double('monto');
            $table->integer('cantidad');
            $table->integer('monto_total');
            
            $table->timeStamps();
            
        });
        
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('recibos');
    }
}
