<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';
    protected $fillable = [
      'assignment_code',
      'assignment_id',
      'status',
      'mutasicode',
      'isedit',
      'department',
      'department_code',
      'posname',
      'poscode',
      'username',
      'userid',
      'department_destination',
      'department_code_destination',
      'posname_destination',
      'poscode_destination',
      'description',
      'created_by',
      'created_byid',
      'attachment1',
      'attachment2',
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('mutasicode', 'like' , '%'.$filters.'%')
                ->orWhere('assignment_code', 'like' , '%'.$filters.'%')
                ->orWhere('status', 'like' , '%'.$filters.'%')
                ->orWhere('username', 'like' , '%'.$filters.'%')
                ->orWhere('created_by', 'like' , '%'.$filters.'%');
        });

    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }
}
