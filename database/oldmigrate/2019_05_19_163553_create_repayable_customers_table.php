<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepayableCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repayables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->float('due')->default(0);
            $table->integer('payment_id')->nullable();
            $table->integer('customer_id');
            $table->integer('comment_id')->nullable();
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
        Schema::dropIfExists('repayable_customers');
    }
}
