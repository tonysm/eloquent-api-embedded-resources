<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->as('joined');
    }

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class)
            ->withTimestamps();
    }
}
