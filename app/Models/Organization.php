<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = "organization";

    protected $fillable = [
        'org_code',
        'org_name',
        'org_type',
        'position_title',
        'position_code',
        'position_category',
        'parent_org',
        'parent_org_code',
        'ishead',
        'havechild'
    ];


}
