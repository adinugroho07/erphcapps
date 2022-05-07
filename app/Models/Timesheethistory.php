<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheethistory extends Model
{
    use HasFactory;

    protected $table = 'timesheethistory';

    protected $fillable = [
        'ownertrxid',
        'status',
        'changeby',
        'memo'
    ];
}
