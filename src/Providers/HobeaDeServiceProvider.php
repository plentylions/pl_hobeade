<?php

namespace HobeaDe\Providers;

use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;


/**
 * Class HobeaDeServiceProvider
 * @package HobeaDe\Providers
 */
class HobeaDeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $container) {
            $container->addStyleTemplate('HobeaDe::Stylesheet');
            $container->addScriptTemplate('HobeaDe::Script');
        }, self::PRIORITY);

        $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container)
        {
            $container->setTemplate('HobeaDe::Item.SingleItemWrapper');
        }, self::PRIORITY);

        $dispatcher->listen('IO.tpl.category.item', function (TemplateContainer $container)
        {
            $container->setTemplate('HobeaDe::Category.Item.CategoryItem');
        }, self::PRIORITY);
    }
}

