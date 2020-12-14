<?php

namespace App\Models;

use Ignite\Crud\Models\Traits\HasMedia;
use Ignite\Crud\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;

class Product extends Model implements HasMediaContract
{
    use HasMedia, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'slug'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * Image attribute.
     *
     * @return \Lit\Crud\Models\Media
     */
    public function getImageAttribute()
    {
        return $this->getMedia('image')->first();
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_categories_pivot');
    }
}
