<?php

namespace App\Models;

use App\Enums\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
      use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time',
        'status',
        'service_type',
    ];

    protected function casts(): array
    {
        return [
            'service_type' => Services::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
