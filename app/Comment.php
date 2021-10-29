<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = ['id'];

    public function user(){
     return $this->belongsTo(User::class,'users_id','id');
    }
}
