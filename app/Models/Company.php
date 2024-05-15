<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute()
    {
        return Storage::disk('public')->url($this->logo);
    }

    public function companies()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
}
