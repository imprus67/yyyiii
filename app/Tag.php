<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
	use Sluggable;

    public function posts()
    {
    	return $this->belongsToMany(
    		Post::class,
    		'post_tags',
    		'tag_id',
    		'post_id'

    	);
    }

     public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
