<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wfprocess extends Model
{
    use HasFactory;

    protected $table = 'wfprocess';

    protected $fillable = [
        'sequencenow',
        'sequencenext',
        'status',
        'ownertrxid',
        'assignment_id',
        'assignment_code',
        'isprocessactive',
    ];
}
