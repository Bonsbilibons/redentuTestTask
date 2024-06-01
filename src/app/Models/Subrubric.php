<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subrubric extends Model
{
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'ident',
    ];
}
