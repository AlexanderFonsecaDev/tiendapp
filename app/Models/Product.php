<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,HasUuid;

    protected $fillable = [
        'size_id',
        'mark_id',
        'name',
        'quantity',
        'date_shipment',
        'observation',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    public function mark()
    {
        return $this->belongsTo(Mark::class,'mark_id');
    }

    protected $dates = [
        'created_at','date_shipment'
    ];

}
