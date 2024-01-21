<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    protected $table = 'shorturls';
    protected $fillable = [
        'user_id',
        'long_url',
        'short_code',
        'description',
        'clicks',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
