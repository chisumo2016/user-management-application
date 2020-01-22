<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //we dont want to create ,
        Schema::table('role_user', function (Blueprint $table) {
            //Adding foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //we dont want to create ,table
        Schema::table('role_user',function (Blueprint $table){
          $table->dropForeign('role_user_user_id_foreign');  //
          $table->dropForeign('role_user_role_id_foreign');//table name , column name
        });
    }
}
