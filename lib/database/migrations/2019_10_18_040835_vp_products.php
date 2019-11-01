<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vp_products', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name');
            $table->string('pro_slug');
            $table->integer('pro_price');
            $table->string('pro_img');
            $table->string('pro_warranty');
            $table->string('pro_accessories');
            $table->string('pro_condition');
            $table->string('pro_promotion');
            $table->tinyInteger('pro_status');
            $table->text('pro_description');
            $table->tinyInteger('pro_featured');
            $table->integer('pro_cate')->unsigned(); 
            // ondelete xoa danh mục nào thì các sản phẩm trong danh mục cũng sẽ bị xóa
            $table->foreign('pro_cate')->references('cate_id')->on('vp_categories')->onDelete('cascade');


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
        Schema::dropIfExists('vp_products');
    }
}
