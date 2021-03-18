<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory,HasUuid;

    protected $fillable = [
        'name',
        'reference'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

}
