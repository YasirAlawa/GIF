<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable , HasRoles;
    Protected $guard_name ='api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function images(){
        return $this->hasMany('App\Image','user_id','id');
    }

    public function searchHistory(){
        return $this->hasMany('App\UserSearch','user_id','id');
    }

    public function getPermissions() {
        $permissions = [];
    
        return $permissions;
    }

    public function getHistory()
    {
        $history = [];
        $ar = $this->searchHistory;
        
        foreach($ar as $sh)
        {
           
            $history[] = [
                'date'=>(new \DateTime($sh->created_at))->format('Y-m-d H:i:s'),
                'key_words'=>$sh->getTagsAsString(),
            ];
        }
        
        return $history;
            
    }
}
