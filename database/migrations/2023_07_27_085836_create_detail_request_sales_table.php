<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailRequestSalesTable extends Migration
{
    public function up(): void
    {
        Schema::create('detail_request_sales', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('id_sale');
            $table->unsignedBigInteger('id_product');
            $table->bigInteger('qty');
            $table->bigInteger('total_price_product');

            $table->foreign('id_sale')->references('id_sale')->on('request_sales')->onDelete('RESTRICT');
            $table->foreign('id_product')->references('id_product')->on('master_products')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_request_sales');
    }
}
