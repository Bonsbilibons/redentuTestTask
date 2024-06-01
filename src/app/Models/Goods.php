<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
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
        'title',
        'article',
        'description',
        'cost',
        'warranty',
        'status',
        'rubric_id',
        'subrubric_id',
        'category_id',
        'manufacturer_id'
    ];

    public function rubric()
    {
        return $this->belongsTo(Rubric::class, 'rubric_id');
    }

    public function subrubric()
    {
        return $this->belongsTo(Subrubric::class, 'subrubric_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
}
