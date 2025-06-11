<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterInggridientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('master_inggridients', function (Blueprint $table): void {
            $table->id('id_inggridient');
            $table->String('name_inggridient');
            $table->bigInteger('qty_inggridient')->default(0);
            $table->String('unit_inggridient');
            $table->bigInteger('price_inggridient');
            $table->integer('duration_expired')->default('1');
            $table->String('time_expired')->default('month');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_inggridients');
    }
}
