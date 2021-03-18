<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory,HasUuid;

    protected $fillable = [
        'name',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

}
