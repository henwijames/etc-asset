<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowTransaction extends Model
{
    protected $fillable = [
        "asset_id",
        "borrower_name",
        "logged_by",
        "borrowed_date",
        "returned_date",
        "status",
        "remarks"
    ];

    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'logged_by');
    }
}
