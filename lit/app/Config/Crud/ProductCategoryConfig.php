<?php

namespace Lit\Config\Crud;

use App\Models\ProductCategory;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Crud\ProductCategoryController;

class ProductCategoryConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = ProductCategory::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = ProductCategoryController::class;

    /**
     * Model singular and plural name.
     *
     * @param ProductCategory|null productCategory
     * @return array
     */
    public function names(ProductCategory $productCategory = null)
    {
        return [
            'singular' => 'ProductCategory',
            'plural'   => 'ProductCategories',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'product-categories';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->table(function ($table) {
            $table->col('Name')->value('{name}')->sortBy('name');
        })->search('title');
    }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->card(function ($form) {
            $form->input('name');
        });
    }
}
