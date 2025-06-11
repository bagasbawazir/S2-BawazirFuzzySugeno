<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInggridientHistoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('inggridient_history', function (Blueprint $table): void {
            $table->id('id_history');
            $table->unsignedBigInteger('id_inggridient');
            $table->date('date');
            $table->bigInteger('stock')->default(0);
            $table->bigInteger('purchase')->default(0);
            $table->bigInteger('stock_in')->default(0);
            $table->bigInteger('stock_out')->default(0);
            $table->bigInteger('last_stock')->default(0);

            $table->foreign('id_inggridient')->references('id_inggridient')->on('master_inggridients')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inggridient_histories');
    }
}
