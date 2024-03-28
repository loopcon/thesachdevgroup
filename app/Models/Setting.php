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
        'email_color',
        'email_font_size',
        'email_font_family',
        'mobile_number',
        'mobile_number_color',
        'mobile_number_font_size',
        'mobile_number_font_family',
        'time',
        'time_color',
        'time_font_size',
        'time_font_family',
        'address',
        'address_color',
        'address_font_size',
        'address_font_family',
        'email_icon',
        'call_icon',
        'address_icon',
        'payment_button_text',
        'payment_button_text_color',
        'payment_button_font_size',
        'payment_button_font_family',
        'payment_button_color',
        'footer_description',
        'footer_description_color',
        'footer_description_font_size',
        'footer_description_font_family',
    ];
}
