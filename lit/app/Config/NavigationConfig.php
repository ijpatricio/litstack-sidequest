<?php

namespace Lit\Config;

use Ignite\Application\Navigation\Config;
use Ignite\Application\Navigation\Navigation;
use Lit\Config\Crud\OrderConfig;
use Lit\Config\Crud\ProductCategoryConfig;
use Lit\Config\Crud\ProductConfig;
use Lit\Config\Form\Pages\WelcomeConfig;

class NavigationConfig extends Config
{
    /**
     * Topbar navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function topbar(Navigation $nav)
    {
        $nav->section([
            $nav->preset('profile'),
        ]);

        $nav->section([
            $nav->title(__lit('navigation.user_administration')),

            $nav->preset('user.user', ['icon' => fa('users')]),
            $nav->preset('permissions'),

            $nav->preset(ProductCategoryConfig::class, ['icon' => fa('list')]),
        ]);
    }

    /**
     * Main navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function main(Navigation $nav)
    {
        $nav->section([
            $nav->title('Pages'),

            $nav->preset(WelcomeConfig::class, ['icon' => fa('home')]),
        ]);

        $nav->section([
            $nav->title('Data'),

            $nav->preset(ProductConfig::class, ['icon' => fa('box')]),
            $nav->preset(OrderConfig::class, ['icon' => fa('dollar-alt')]),

        ]);
    }
}
