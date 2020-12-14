<?php

namespace Lit\Config\Crud;

use App\Models\Product;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Filters\ProductCategoryFilter;
use Lit\Http\Controllers\Crud\ProductController;

class ProductConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Product::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = ProductController::class;

    /**
     * Model singular and plural name.
     *
     * @param Product|null product
     * @return array
     */
    public function names(Product $product = null)
    {
        return [
            'singular' => $product->name ?? 'Product',
            'plural'   => 'Products',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'products';
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
            $table->image('Image')->src('image.conversion_urls.sm')->square('50px')->small();
            $table->col('Name')->value('{name}')->sortBy('name');
            $table->field('Name')->input('name');
            $table->col('Description')->value('{description}')->sortBy('description');
        })
            ->search('name', 'categories.name')
            ->filter([
                'Category' => ProductCategoryFilter::class,
            ]);
    }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->group(function ($page) {
            $page->card(function ($form) {
                $form->input('name')->hint('The product title.')->width(8);
                $form->input('price')->type('number')->width(4);
                $form->text('description');
            });

            $page->card(function ($form) {
                $form->relation('categories');
            });
        })->width(8);

        $page->card(function ($form) {
            $form->image('image')->maxFiles(1)->crop(4 / 3);
        })->width(4);
    }
}
