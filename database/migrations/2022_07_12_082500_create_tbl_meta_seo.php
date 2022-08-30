<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_meta', function (Blueprint $table) {
            $table->Increments('meta_id');
            $table->text('meta_desc');
            $table->text('meta_title');
            $table->integer('meta_status');
            $table->timestamps();//lấy ngày hiện tại tạo table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_meta');
    }
};
