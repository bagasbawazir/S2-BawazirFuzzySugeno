<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInggridientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_inggridients', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_inggridient');
            $table->bigInteger('usage_amount');

            $table->foreign('id_product')->references('id_product')->on('master_products')->onDelete('cascade');
            $table->foreign('id_inggridient')->references('id_inggridient')->on('master_inggridients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_inggridients');
    }
}
