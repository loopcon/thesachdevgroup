<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'logo',
        'email',
        'mobile_number',
        'time',
        'twitter_link',
        'linkedin_link',
        'facebook_link',
        'address',
        'email_icon',
        'call_icon',
        'footer_description',
    ];
}
