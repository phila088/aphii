<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword, Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, \OwenIt\Auditing\Auditable;

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
        'phone_mobile',
        'phone_work',
        'phone_work_extension',
        'sex',
        'date_of_birth',
        'timezone',
        'remember_token',
        'deleted_at',
        'user_id',
        'client_id',
        'vendor_id',
        'welcome_valid_until',
        'last_activity',
    ];

    protected $auditExclude = [
        'last_activity',
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

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function contactDepartment(): HasMany
    {
        return $this->hasMany(ContactDepartment::class);
    }

    public function contactTitle(): HasMany
    {
        return $this->hasMany(ContactTitle::class);
    }

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

    public function email(): HasMany
    {
        return $this->hasMany(BrandEmail::class);
    }

    public function brandHoliday(): HasMany
    {
        return $this->hasMany(BrandHoliday::class);
    }

    public function brandHour(): HasMany
    {
        return $this->hasMany(BrandHour::class);
    }

    public function brandPhoneNumber(): HasMany
    {
        return $this->hasMany(BrandPhoneNumber::class);
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
