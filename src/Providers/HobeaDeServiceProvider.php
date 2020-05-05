<?php

namespace HobeaDe\Providers;

use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use IO\Extensions\Functions\Partial;
use IO\Helper\ComponentContainer;
use Plenty\Modules\ShopBuilder\Contracts\ContentWidgetRepositoryContract;

use HobeaDe\Widgets\WidgetCollection;

use HobeaDe\Extensions\AwinExtension;

class HobeaDeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        $twig->addExtension(AwinExtension::class);

        $widgetRepository = pluginApp(ContentWidgetRepositoryContract::class);
        $widgetClasses = WidgetCollection::all();
        foreach ($widgetClasses as $widgetClass) {
            $widgetRepository->registerWidget($widgetClass);
        }

        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $container) {
            $container->addStyleTemplate('HobeaDe::Stylesheet');
            $container->addScriptTemplate('HobeaDe::Script');
        }, self::PRIORITY);

        $dispatcher->listen('IO.Component.Import', function (ComponentContainer $componentContainer)
        {
            if($componentContainer->getOriginComponentTemplate() == 'Legend::Item.Components.VariationSelect'){
                $componentContainer->setNewComponentTemplate('HobeaDe::Item.Components.VariationSelect');
            }
            if($componentContainer->getOriginComponentTemplate() == 'Legend::Item.Components.SingleItem'){
                $componentContainer->setNewComponentTemplate('HobeaDe::Item.Components.SingleItem');
            }
        }, self::PRIORITY);

        $dispatcher->listen('IO.init.templates', function (Partial $partial)
        {
            $partial->set('head', 'Ceres::PageDesign.Partials.Head');
            $partial->set('header', 'Legend::PageDesign.Partials.Header.Header');
            $partial->set('page-design', 'Legend::PageDesign.PageDesign');
            $partial->set('page-metadata', 'Legend::PageDesign.Partials.PageMetadata');
            $partial->set('footer', 'HobeaDe::PageDesign.Partials.Footer');
        }, self::PRIORITY);
    }
}

