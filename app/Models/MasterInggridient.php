<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterInggridient extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'master_inggridients';
    protected $primaryKey = 'id_inggridient';

    protected $fillable = [
        'name_inggridient',
        'qty_inggridient',
        'unit_inggridient',
        'price_inggridient',
        'duration_expired',
        'time_expired',
    ];

    public function inggridient_history()
    {
        return $this->hasMany(InggridientHistory::class, 'id_inggridient', 'id_inggridient');
    }

    public function master_products()
    {
        return $this->belongsToMany(MasterProduct::class, 'product_inggridients', 'id_inggridient', 'id_product');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'detail_purchases', 'id_inggridient', 'id_purchase')->withPivot('date_expired', 'qty', 'total_price_inggridient');
    }
}
