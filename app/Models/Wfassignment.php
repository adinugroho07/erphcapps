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

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('assignment_code', 'like' , '%'.$filters.'%')
                ->orWhere('sequence', 'like' , '%'.$filters.'%')
                ->orWhere('assignstatus', 'like' , '%'.$filters.'%')
                ->orWhere('modulename', 'like' , '%'.$filters.'%')
                ->orWhere('codetransaction', 'like' , '%'.$filters.'%')
                ->orWhere('assignperson', 'like' , '%'.$filters.'%');
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
