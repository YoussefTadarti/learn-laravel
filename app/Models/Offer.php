<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['name_en','price','name_fr','details_fr','details_en','image'];
    protected $hidden = ['created_at','updated_at'];
}
