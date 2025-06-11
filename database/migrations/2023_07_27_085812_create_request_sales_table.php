<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSalesTable extends Migration
{
    public function up(): void
    {
        Schema::create('request_sales', function (Blueprint $table): void {
            $table->id('id_sale');
            $table->unsignedBigInteger('id_user');
            $table->integer('qty_sale');
            $table->date('date_sale');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_sales');
    }
}
