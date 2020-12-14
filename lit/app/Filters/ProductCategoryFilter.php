<?php

namespace Lit\Filters;

use App\Models\ProductCategory;
use Ignite\Crud\Filter\Filter;
use Ignite\Crud\Filter\FilterForm;
use Ignite\Support\AttributeBag;
use Illuminate\Database\Eloquent\Builder;

class ProductCategoryFilter extends Filter
{
    /**
     * Apply field attributes to query.
     *
     * @param Builder      $query
     * @param AttributeBag $attributes
     * @var   void
     */
    public function apply($query, AttributeBag $attributes)
    {
        if ($attributes->has('category')) {
            $query->whereHas('categories', function ($query) use ($attributes) {
                $query->where('name', $attributes->category);
            });
        }

        if ($attributes->has('name')) {
            $query->where('name', 'LIKE', "%{$attributes->name}%");
        }
    }

    /**
     * Add filter form fields.
     *
     * @param  FilterForm $form
     * @return void
     */
    public function form(FilterForm $form)
    {
        $categories = ProductCategory::all();

        $form->radio('category')->options(
            $categories->mapWithKeys(function ($cat) {
                return [$cat->name => $cat->name];
            })->toArray()
        );

        $form->input('name');
    }
}
