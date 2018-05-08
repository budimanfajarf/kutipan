<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use LikesTrait;

    protected $fillable = [
        'title', 'slug', 'subject', 'user_id'
    ];    

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function quoteComments()
    {
        return $this->hasMany('App\Models\QuoteComment');
    }            

    public function isQuoteOwner()
    {
        if (Auth::guest())
            return false;
            
        return Auth::user()->id == $this->user->id;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
}
