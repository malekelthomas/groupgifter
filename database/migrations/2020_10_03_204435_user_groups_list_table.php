<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserGroupsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_groups_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_list_id')->references('id')->on('users');
            $table->foreignId('group_id')->references('group_id')->on('groups_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_groups_list', function (Blueprint $table) {
            $table->dropColumn(['group_list_id', 'group_id']);
        });
    }
}
