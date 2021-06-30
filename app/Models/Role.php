<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    //query scope
   public static function scopeLatest($query)
   {
       return $query->orderBy('id','desc');
   }
}
