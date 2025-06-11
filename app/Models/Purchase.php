<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'purchases';
    protected $primaryKey = 'id_purchase';

    protected $fillable = [
        'id_supplier',
        'id_user',
        'qty_purchase_inggridient',
        'date_purchase',
        'description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    public function master_inggridients()
    {
        return $this->belongsToMany(MasterInggridient::class, 'detail_purchases', 'id_purchase', 'id_inggridient')->withPivot('date_expired', 'qty', 'total_price_inggridient');
    }
}
