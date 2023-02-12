<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPU extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'clock',
        'vram',
        'manufacturer_id',
        'user_id',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
