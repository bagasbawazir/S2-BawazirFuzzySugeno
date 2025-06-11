<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailRequestSale extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detail_request_sales';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_sale',
        'id_product',
        'qty',
        'total_price_product',
    ];
}
