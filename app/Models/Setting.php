<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



    public function getAppLogoAttribute()
    {
        return asset('storage/'. $this->attributes['app_logo']);
    }
    public function getAppFaviconAttribute()
    {
        return asset('storage/'. $this->attributes['app_favicon']);
    }
}
