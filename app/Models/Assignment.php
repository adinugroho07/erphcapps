<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';

    protected $fillable = [
        'assignment_code',
        'assignment_name',
        'assignment_description',
        'isactive',
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('assignment_code', '=' , $filters)
                ->orWhere('assignment_name', 'like' , '%'.$filters.'%')
                ->orWhere('assignment_description', 'like' , '%'.$filters.'%');
        });

    }

    public function assignmentdetail(){
        return $this->hasMany(Assignmentdetail::class);
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
