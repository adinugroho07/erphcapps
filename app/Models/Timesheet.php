<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $table = 'timesheet';

    protected $fillable = [
      'assignment_code',
      'assignment_id',
      'createdby',
      'createdbyid',
      'status',
      'timesheetcode',
      'isedit',
      'name',
      'email',
      'description',
      'periode',
      'year',
      'attachment1',
      'attachment2',
      'attachment3',
      'attachment4',
    ];
}
