<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleheader extends Model
{
    use HasFactory;
    protected $table = 'roleheader';
    protected $fillable = [
        'rolecode',
        'rolename',
        'description',
        'created_by',
        'created_byid',
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('rolecode', 'like' , '%'.$filters.'%')
                ->orWhere('rolename', 'like' , '%'.$filters.'%')
                ->orWhere('created_by', 'like' , '%'.$filters.'%')
                ->orWhere('description', 'like' , '%'.$filters.'%');
        });

    }

    public function role(){
        return $this->hasOne(Role::class);
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
