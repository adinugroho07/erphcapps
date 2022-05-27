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

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('timesheetcode', '=' , $filters)
                ->orWhere('assignment_code', 'like' , '%'.$filters.'%')
                ->orWhere('description', 'like' , '%'.$filters.'%')
                ->orWhere('status', '=' , $filters)
                ->orWhere('createdby', 'like' , '%'.$filters.'%');
        });

    }
}
