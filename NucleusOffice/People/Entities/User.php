<?php

namespace NucleusOffice\People\Entities;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NucleusOffice\People\Notifications\VerifyEmail;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, GeneratesUuid, HasRoles, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'current_tenancy_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'uuid' => 'uuid'
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function tenancies()
    {
        return $this->belongsToMany(Tenancy::class);
    }
}
