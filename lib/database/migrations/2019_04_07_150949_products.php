<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('prod_id');
            $table->string('prod_name');
            $table->string('prod_slug');
            $table->integer('prod_price');
            $table->string('prod_img');
            $table->string('prod_warranty');//bảo hành
            $table->string('prod_accessories');//phụ kiện
            $table->string('prod_condition');//tình trạng
            $table->integer('prod_promotion');//khuyến mại
            $table->tinyInteger('prod_status');
            $table->text('prod_description');
            $table->tinyInteger('prod_featured');//sản phẩm đặc biệt
            $table->integer('prod_cate')->unsigned();//phải là số nguyên
            $table->foreign('prod_cate')->references('cate_id')->on('categories')->onDelete('cascade');//khóa phụ
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
        Schema::dropIfExists('products');
    }
}
