<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false; // Because primary key is a string (order_id)
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'amount',
        'status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
