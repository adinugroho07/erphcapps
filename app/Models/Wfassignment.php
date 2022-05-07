<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wfassignment extends Model
{
    use HasFactory;

    protected $table = 'wfassignment';

    protected $fillable = [
        'assignment_code',
        'description',
        'sequence',
        'assignstatus',
        'modulename',
        'codetransaction',
        'origperson',
        'origpersonid',
        'assignperson',
        'assignpersonid',
        'ownertrxid',
        'processid',
        'assignment_id',
        'link',
    ];
}
