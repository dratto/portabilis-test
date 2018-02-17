<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCancelDateFieldAndRemoveIdPaidFieldOnTableRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->date('cancel_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->boolean('is_paid')->default(0);
            $table->dropColumn('cancel_date');
        });
    }
}
