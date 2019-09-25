<?php

namespace HobeaDe\Providers;

use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use IO\Extensions\Functions\Partial;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;
use IO\Helper\ComponentContainer;

use HobeaDe\Extensions\AwinExtension;


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
        $twig->addExtension(AwinExtension::class);

        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $container) {
            $container->addStyleTemplate('HobeaDe::Stylesheet');
            $container->addScriptTemplate('HobeaDe::Script');
        }, self::PRIORITY);

        $dispatcher->listen('IO.Component.Import', function (ComponentContainer $componentContainer)
        {
            if($componentContainer->getOriginComponentTemplate() == 'Legend::Item.Components.VariationSelect'){
                $componentContainer->setNewComponentTemplate('HobeaDe::Item.Components.VariationSelect');
            }
        }, self::PRIORITY);

        $dispatcher->listen('IO.init.templates', function (Partial $partial)
        {
            $partial->set('head', 'Legend::PageDesign.Partials.Head');
            $partial->set('header', 'HobeaDe::PageDesign.Partials.Header.Header');
            $partial->set('page-design', 'HobeaDe::PageDesign.PageDesign');
            $partial->set('footer', 'HobeaDe::PageDesign.Partials.Footer');
            $partial->set('page-metadata', 'Legend::PageDesign.Partials.PageMetadata');
        }, self::PRIORITY);

        $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container)
        {
            $container->setTemplate('HobeaDe::Item.SingleItemWrapper');
        }, self::PRIORITY);

        $dispatcher->listen( 'IO.ResultFields.*', function(ResultFieldTemplate $container) {
            $container->setTemplates([
                ResultFieldTemplate::TEMPLATE_SINGLE_ITEM => 'HobeaDe::ResultFields.SingleItem', // variationProperties.*
            ]);
        }, self::PRIORITY);
    }
}

