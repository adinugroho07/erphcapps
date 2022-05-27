<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = "applicant";

    protected $fillable = [
        'status',
        'applicantcode',
        'assignment_id',
        'assignment_code',
        'department',
        'department_code',
        'posname',
        'poscode',
        'isedit',
        'name',
        'email',
        'gender',
        'birthdate',
        'placeborn',
        'address',
        'religion',
        'married',
        'NIK',
        'NPWP',
        'bloodtype',
        'districts',
        'city',
        'postalcode',
        'citizenship',
        'phonenumber',
        'degree',
        'lastdegree',
        'major',
        'studyprogram',
        'startschool',
        'endschool',
        'positionexporg',
        'orgname',
        'orgdescriptions',
        'inorg',
        'outorg',
        'ijazah',
        'cv'
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('name', 'like' , '%'.$filters.'%')
                ->orWhere('email', 'like' , '%'.$filters.'%')
                ->orWhere('applicantcode', 'like' , '%'.$filters.'%')
                ->orWhere('NIK', 'like' , '%'.$filters.'%')
                ->orWhere('degree', 'like' , '=' , $filters)
                ->orWhere('status', '=' , $filters);
        });

    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y H:i:s');
    }
}
