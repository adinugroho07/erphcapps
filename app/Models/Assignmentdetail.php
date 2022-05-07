<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmentdetail extends Model
{
    use HasFactory;

    protected $table = 'assignment_detail';

    protected $fillable = [
        'assignment_id',
        'assignment_code',
        'assignment_description',
        'sequence',
        'status',
        'assignmeto',
        'assignmetoid',
        'delegateto',
        'delegatetoid',
        'apprnote'
    ];

    public function asignment(){
        return $this->belongsTo(Assignment::class);
    }
}
