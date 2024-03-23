<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_admin',
        'is_client',
        'is_employee',
        'is_vendor',
        'active',
        'locked',
        'profile_picture_path',
        'first_name',
        'last_name',
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone_fax',
        'phone_mobile',
        'phone_work',
        'sex',
        'date_of_birth',
        'facebook',
        'instagram',
        'tiktok',
        'twitter',
        'url',
        'remember_token',
        'deleted_at',
        'user_id',
        'client_id',
        'vendor_id',
        'welcome_valid_until',
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
        'password' => 'hashed',
    ];

    public function documentCategories(): HasMany
    {
        return $this->hasMany(DocumentCategory::class);
    }

    public function brand(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function address(): HasMany
    {
        return $this->hasMany(BrandAddress::class);
    }

    public function potentialClient(): HasMany
    {
        return $this->hasMany(PotentialClient::class);
    }

    public function paymentTerm(): HasMany
    {
        return $this->hasMany(PaymentTerm::class);
    }

    public function client(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function clientNote(): HasMany
    {
        return $this->hasMany(ClientNote::class);
    }

    public function clientRate(): HasMany
    {
        return $this->hasMany(ClientRate::class);
    }

    public function clientPortal(): HasMany
    {
        return $this->hasMany(ClientPortal::class);
    }

    public function clientBillingInstruction(): HasMany
    {
        return $this->hasMany(ClientBillingInstruction::class);
    }

    public function location(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function clientCoverageArea(): HasMany
    {
        return $this->hasMany(ClientCoverageArea::class);
    }
}
