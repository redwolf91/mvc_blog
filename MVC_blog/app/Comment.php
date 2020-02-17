<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'billet_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function billet(){
        return $this->belongsTo('App\Billet');
    }

}
