<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    use HasFactory;

    protected $table = "doa";

    protected $fillable = [
        'justification',
        'assignment_code',
        'assignment_id',
        'status',
        'isedit',
        'doacode',
        'oridepartment',
        'oriposition',
        'alias',
        'alias_id',
        'alias_acting',
        'alias_acting_id',
        'start_date',
        'end_date',
        'created_by',
        'is_active',
        'attachment1',
        'attachment2',
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('doacode', 'like' , '%'.$filters.'%')
                ->orWhere('assignment_code', 'like' , '%'.$filters.'%')
                ->orWhere('alias', 'like' , '%'.$filters.'%')
                ->orWhere('alias_acting', 'like' , '%'.$filters.'%')
                ->orWhere('created_by', 'like' , '%'.$filters.'%')
                ->orWhere('status', 'like' , '%'.$filters.'%');
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
