<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = "absen";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email','department','posname','user_id','activity','absentype','absenvalue'
    ];

    public function scopeSearch($query, $filters){
        //jika value filter search tidak ada maka tidak akan query.
        //fungsi when adalah ketika hasil yang di dapat adalah true. jika true maka function akan di jalan kan.
        //jika false maka akan di skip function nya.
        $query->when($filters['search'] ?? false, function($query,$filters){
            return $query->where('name', 'like' , '%'.$filters.'%')
                ->orWhere('email', 'like' , '%'.$filters.'%')
                ->orWhere('department', 'like' , '%'.$filters.'%')
                ->orWhere('posname', 'like' , '%'.$filters.'%')
                ->orWhere('activity', 'like' , '%'.$filters.'%')
                ->orWhere('absentype', 'like' , '%'.$filters.'%')
                ->orWhere('absenvalue', 'like' , '%'.$filters.'%');
        });

    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y H:i:s');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
