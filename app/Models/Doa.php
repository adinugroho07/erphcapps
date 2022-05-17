<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    use HasFactory;

    protected $table = "doa";

    protected $fillable = [
        'justification',
        'assignment_code',
        'assignment_id',
        'status',
        'isedit',
        'doacode',
        'oridepartment',
        'oriposition',
        'alias',
        'alias_id',
        'alias_acting',
        'alias_acting_id',
        'start_date',
        'end_date',
        'created_by',
        'is_active',
        'attachment1',
        'attachment2',
    ];

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }
}
