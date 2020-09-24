<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
     protected $fillable = ['title','graphic','show_count','total_rate','invalid_rate','sort'];
}
