<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InggridientHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'inggridient_history';
    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_inggridient',
        'date',
        'stock',
        'purchase',
        'stock_in',
        'stock_out',
        'last_stock'
    ];

    public function master_inggridients()
    {
        return $this->belongsTo(MasterInggridient::class, 'id_inggridient', 'id_inggridient');
    }
}
