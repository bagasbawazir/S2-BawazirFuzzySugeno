<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductInggridient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product_inggridients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_product',
        'id_inggridient',
        'usage_amount',
    ];
}
