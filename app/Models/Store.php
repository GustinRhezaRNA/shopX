<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'seller_id',
        'logo',
        'banner',
        'phone',
        'email',
        'address',
        'short_description',
        'long_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
