<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'nik',
        'password',
        'suppervisor',
        'suppervisor_posname',
        'suppervisor_id',
        'position_category',
        'department',
        'department_code',
        'posname',
        'poscode',
        'status',
        'expiredcontractdate',
        'posstatus',
        'sex',
        'birthdate',
        'religion',
        'spouse',
        'child1',
        'child2',
        'child3',
        'married',
        'state',
        'city',
        'phonenum',
        'bankkey',
        'address',
        'backtoback',
        'backtoback_id',
        'postalcode',
        'bank',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expiredcontractdate' => 'datetime',

    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y H:i:s');
    }

    public function getExpiredcontractdateAttribute($value){
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y');
    }

    public function getBirthdateAttribute($value){
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }

    public function role(){
        return $this->hasMany(Role::class);
    }

    public function absen(){
        return $this->hasMany(Absen::class);
    }

    public function jatahcuti(){
        return $this->hasOne(Jatahcuti::class);
    }

}
