<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'privilege_id',
        'school_id',
        'pronoun_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Eloquent relationship for user->school */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /* Eloquent relationship for user->privilege */
    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }

    /* Eloquent relationship for user->pronoun */
    public function pronoun()
    {
        return $this->belongsTo(Pronoun::class);
    }

    /**
     * Checks if a user is at or above the given privilege.
     *
     * @param string $privilegeTitle
     * @return bool
     */
    public function privilegeCheck(string $privilegeTitle) {
        $permissionTranslation = config('privileges.privilege_map');

        $userPermission = $permissionTranslation[strtoupper($this->privilege->title)];
        $privilegeTitle = $permissionTranslation[strtoupper($privilegeTitle)];

        $passCheck = null;

        if ($userPermission < $privilegeTitle) {
            $passCheck = false;
        } else {
            $passCheck = true;
        }

        return $passCheck;
    }
}
