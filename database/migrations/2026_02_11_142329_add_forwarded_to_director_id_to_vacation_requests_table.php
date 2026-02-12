<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForwardedToDirectorIdToVacationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacation_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('forwarded_to_director_id')->nullable()->after('approvalStatus');
            $table->foreign('forwarded_to_director_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacation_requests', function (Blueprint $table) {
            $table->dropForeign(['forwarded_to_director_id']);
            $table->dropColumn('forwarded_to_director_id');
        });
    }
}
