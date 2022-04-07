<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    use HasFactory;

    protected $table = "role";

    protected $fillable = [
        'justification',
        'oridepartment',
        'oriposition',
        'alias',
        'alias_id',
        'alias_acting',
        'alias_acting_id',
        'start_date',
        'end_date',
        'created_by',
        'is_active'
    ];
}
