<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $guarded = [];

     /* protected $fillable = [
        'title',
        'short_title',
        'home_slide',
        'video_url',
    ]; not needed because guarded is here*/
}
