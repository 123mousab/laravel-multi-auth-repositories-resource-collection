<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Define the relationship between the given post
     * and the user it was created by.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Like the current post.
     *
     * @return void
     */
    public function like($user = null)
    {
        $user = $user ?: auth()->user();
        $this->likes()->attach($user);
    }

    /**
     * Define the relationship between the given "likable" (post)
     * and the "likes" associated with it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likes()
    {
        return $this->morphToMany(User::class, 'likable')->withTimestamps();
    }
}
