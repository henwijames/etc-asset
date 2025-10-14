<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    protected $fillable = [
        'asset_name',
        'category_id',
        'serial_number',
        'status',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class);
    }
}
