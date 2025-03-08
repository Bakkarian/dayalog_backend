<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'patasente_id',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function booted(): void
    {
        static::addGlobalScope('onlyForOrganization', function (Builder $builder) {
            $builder->when(session()->get('organization_id') || getPermissionsTeamId() ,  function ($q){
                $q->whereHas('organizations' , function ($q){
                    $q->whereIn('organizations.id', [session()->get('organization_id') ?? getPermissionsTeamId() ]  );
                });
            });
        });
    }



    public function organizationUser():hasMany
    {
        return $this->hasMany(OrganizationUser::class);

    }


    public function currentOrganizationUser()
    {
        //TO attempt tp keep it in session
        return  $this->organizationUser()->where('organization_id', session()->get('organization_id') ?? getPermissionsTeamId() )->first();
    }


    /**
     * The roles that belong to the user.
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }


    public function ownedOrganizations(): HasMany
    {
        return $this->hasMany(Organization::class, 'created_by');
    }
}
