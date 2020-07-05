<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    protected $hidden = ['author'];

    protected $appends = ['author_name'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getAuthorNameAttribute($value)
    {
        return $this->author->name;
    }

}
