<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheetdetail extends Model
{
    use HasFactory;

    protected $table = 'timesheet_detail';

    protected $fillable = [
        'timesheet_id',
        'workstatus',
        'tanggal',
        'starthours',
        'endhours',
        'totalhours',
        'hadir',
        'worklocation',
        'remarks',
    ];
}
