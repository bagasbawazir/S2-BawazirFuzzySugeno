<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('master_products', function (Blueprint $table): void {
            $table->id('id_product');
            $table->String('name_product');
            $table->String('unit_product')->default('cup');
            $table->bigInteger('price_product');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_products');
    }
}
