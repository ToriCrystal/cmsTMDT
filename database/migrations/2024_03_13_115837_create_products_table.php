<?php

use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->double('price');
            $table->double('price_selling')->nullable();
            $table->double('price_promotion')->nullable();
            $table->char('sku', 255)->nullable();
            $table->tinyInteger('manage_stock')->default(0);
            $table->integer('qty');
            $table->tinyInteger('in_stock')->default(StockStatus::InStock->value);
            $table->text('feature_image')->nullable();
            $table->tinyInteger('status')->default(DefaultStatus::Published->value);
            $table->text('gallery')->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->integer('viewed')->nullable()->default(0);
            $table->char('longitude', 255)->nullable();
            $table->char('latitude', 255)->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('store_categories')->onDelete('cascade');
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
};
