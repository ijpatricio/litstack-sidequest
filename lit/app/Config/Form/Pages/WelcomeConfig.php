<?php

namespace Lit\Config\Form\Pages;

use App\Models\Product;
use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Pages\WelcomeController;

class WelcomeConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = WelcomeController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'pages/welcome';
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Welcome',
        ];
    }

    /**
     * Setup form page.
     *
     * @param  \Lit\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->card(function ($form) {
            $form->input('title')->width(12);
            $form->wysiwyg('description');
        });

        $page->card(function ($form) {
            $form->manyRelation('featured_products')
                ->model(Product::class)
                ->sortable()
                ->preview(function ($preview) {
                    $preview->col('Name')->value('{name}');
                })
                ->form(function ($form) {
                    $form->input('name')->hint('The product title.')->width(8);
                    $form->input('price')->type('number')->width(4);
                    $form->text('description');
                });
        });
    }
}
