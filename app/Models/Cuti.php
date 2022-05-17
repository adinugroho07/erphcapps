<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'assignment_code',
        'assignment_id',
        'status',
        'cuticode',
        'isedit',
        'department',
        'department_code',
        'posname',
        'poscode',
        'name',
        'email',
        'description',
        'nik',
        'typecuti',
        'startdate',
        'enddate',
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
