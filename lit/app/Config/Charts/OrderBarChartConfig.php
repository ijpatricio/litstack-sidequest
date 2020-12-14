<?php

namespace Lit\Config\Charts;

use Ignite\Chart\Chart;
use Ignite\Chart\Config\BarChartConfig;

class OrderBarChartConfig extends BarChartConfig
{
    /**
     * The model class of the chart.
     *
     * @var string
     */
    public $model = \App\Models\Order::class;

    /**
     * Chart title.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Orders';
    }

    /**
     * Mount.
     *
     * @param  Chart $chart
     * @return void
     */
    public function mount(Chart $chart)
    {
        $chart->currency('€');
    }

    /**
     * Calculate value.
     *
     * @param  Builder $query
     * @return int
     */
    public function value($query)
    {
        return $this->sum($query, 'amount');
    }
}
