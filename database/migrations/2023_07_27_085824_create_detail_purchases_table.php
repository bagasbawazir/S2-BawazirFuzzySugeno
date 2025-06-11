<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPurchasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('detail_purchases', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('id_purchase');
            $table->unsignedBigInteger('id_inggridient');
            $table->date('date_expired');
            $table->bigInteger('qty');
            $table->bigInteger('total_price_inggridient');

            $table->foreign('id_purchase')->references('id_purchase')->on('purchases')->onDelete('RESTRICT');
            $table->foreign('id_inggridient')->references('id_inggridient')->on('master_inggridients')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_purchases');
    }
}
