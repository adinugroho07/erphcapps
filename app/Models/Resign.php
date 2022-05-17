<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resign extends Model
{
    use HasFactory;

    protected $table = 'resign';

    protected $fillable = [
        'assignment_code',
        'assignment_id',
        'status',
        'resigncode',
        'isedit',
        'department',
        'department_code',
        'posname',
        'poscode',
        'name',
        'email',
        'description',
        'nik',
        'startwork',
        'endwork',
        'created_by',
        'created_byid',
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
