<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id',
        'showroom_id',
        'service_center_id',
        'body_shop_id',
        'used_car_id',
        'name',
        'email',
        'password',
        'visible_password',
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

    public function businessDetail()
    {
        return $this->belongsTo(OurBusiness::class,'business_id');
    }

    public function showroomDetail()
    {
        return $this->belongsTo(Showroom::class,'showroom_id');
    }

    public function serviceCenterDetail()
    {
        return $this->belongsTo(ServiceCenter::class,'service_center_id');
    }

    public function bodyShopDetail()
    {
        return $this->belongsTo(Body_shop::class,'body_shop_id');
    }

    public function usedCarDetail()
    {
        return $this->belongsTo(Used_car::class,'used_car_id');
    }
}
