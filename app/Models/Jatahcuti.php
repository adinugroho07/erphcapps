<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jatahcuti extends Model
{
    use HasFactory;

    protected $table = 'jatahcuti';

    protected $fillable = [
        'user_id',
        'cutitahunan',
        'cutimelahirkan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
