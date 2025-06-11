<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table): void {
            $table->id('id_purchase');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_supplier');
            $table->bigInteger('qty_purchase_inggridient');
            $table->text('description_purchase')->nullable();
            $table->date('date_purchase');
            $table->timestamps();

            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers')->onDelete('RESTRICT');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
}
