<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'title', 'url', 'width', 'height', 'user_id'
    ];

    public function user(){
        return $this->belongsTo( 'App\User', 'user_id' );
    }

}
