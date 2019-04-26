<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->password->bcrypt($fields['password']);
        $user->save();

        return $user;

    }

    public function edit()
    {
        $this->fill($fields);

        $this->password->bcrypt($fields['password']);

        $this->save();

    }

    public function remove()
    {
        Storage::delete('uploads/' . $this->image);

        $this->delete();
    }

        public function uploadAvatar($image)
    {
        if ($image == null) {return;}
        else {
        Storage::delete('uploads/' . $this->image);

        $filename = str_random(10) . '.' . $image->extention();

        $image->saveAs('uploads', $filename);

        $this->image = $filename;

        $this->save();
            }
    }

     public function getImage()
        {
            if ($this->image == null) {
               
                return '/img/no-image-user.png'

            } else {

                return '/uploads/' . $this->image;

            }
                   
        }

        public function makeAdmin()
        {
            $this->is_admin = 1;
        }

         public function makeNormal()
        {
            $this->is_admin = 0;
        }

}
