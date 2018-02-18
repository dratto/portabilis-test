<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registration_id');
            $table->enum('type', ['registration_fee', 'monthly_fee']);
            $table->decimal('value_to_pay');
            $table->decimal('value_paid')->default(0.00);
            $table->boolean('status')->default(0);
            $table->date('deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('registration_id')->references('id')->on('registration')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
