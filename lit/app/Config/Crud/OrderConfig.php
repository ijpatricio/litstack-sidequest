<?php

namespace Lit\Config\Crud;

use App\Models\Order;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Config\Charts\OrderAreaChartConfig;
use Lit\Config\Charts\OrderBarChartConfig;
use Lit\Http\Controllers\Crud\OrderController;

class OrderConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Order::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = OrderController::class;

    /**
     * Model singular and plural name.
     *
     * @param Order|null order
     * @return array
     */
    public function names(Order $order = null)
    {
        return [
            'singular' => 'Order',
            'plural'   => 'Orders',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'orders';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->chart(OrderAreaChartConfig::class)->height('110px')->width(1 / 2);
        $page->chart(OrderBarChartConfig::class)->height('110px')->width(1 / 2)->variant('secondary');

        $page->table(function ($table) {
            $table->col('Amount')->value('{amount}')->sortBy('amount');
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
            $form->input('title');
        });
    }
}
