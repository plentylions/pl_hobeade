<?php

namespace HobeaDe\Widgets\Header;

use Ceres\Widgets\Helper\BaseWidget;
use Ceres\Widgets\Helper\Factories\Settings\ValueListFactory;
use Ceres\Widgets\Helper\Factories\WidgetSettingsFactory;
use Ceres\Widgets\Helper\WidgetCategories;
use Ceres\Widgets\Helper\Factories\WidgetDataFactory;
use Ceres\Widgets\Helper\WidgetTypes;

class TopBarWidget extends BaseWidget
{
    protected $template = "HobeaDe::Widgets.Header.TopBarWidget";

    public function getData()
    {
        return WidgetDataFactory::make("HobeaDe::TopBarWidget")
            ->withLabel("Widget.topBarLabel")
            ->withPreviewImageUrl("/images/widgets/top-bar.svg")
            ->withType(WidgetTypes::HEADER)
            ->withCategory("header")
            ->withPosition(0)
            ->withAllowedNestingTypes(
                [
                    WidgetTypes::STRUCTURE,
                    WidgetTypes::STATIC,
                    WidgetTypes::DEFAULT,
                    WidgetTypes::ITEM_SEARCH
                ]
            )
            ->toArray();
    }

    public function getSettings()
    {
        /** @var WidgetSettingsFactory $settingsFactory */
        $settingsFactory = pluginApp(WidgetSettingsFactory::class);

        $settingsFactory->createCustomClass();

        $settingsFactory->createCodeEditor("customHtml")
            ->withName("Widget.topBarCustomHtmlLabel");

        $settingsFactory->createCheckbox("showLanguageSelectFlags")
            ->withName("Widget.topBarShowLanguageSelectFlagsLabel")
            ->withDefaultValue(false);

        $settingsFactory->createCheckbox("enableLogin")
            ->withName("Widget.topBarEnableLoginLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableRegistration")
            ->withName("Widget.topBarEnableRegistrationLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableLanguageSelect")
            ->withName("Widget.topBarEnableLanguageSelectLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableShippingCountrySelect")
            ->withName("Widget.topBarEnableShippingCountrySelectLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableCurrencySelect")
            ->withName("Widget.topBarEnableCurrencySelectLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableWishList")
            ->withName("Widget.topBarEnableWishListLabel")
            ->withDefaultValue(true);

        $settingsFactory->createCheckbox("enableBasketPreview")
            ->withName("Widget.topBarEnableBasketPreviewLabel")
            ->withDefaultValue(true);

        $settingsFactory->createSelect("basketValues")
            ->withName("Widget.topBarBasketValuesLabel")
            ->withTooltip("Widget.topBarBasketValuesTooltip")
            ->withDefaultValue("sum")
            ->withCondition("enableBasketPreview")
            ->withListBoxValues(
                ValueListFactory::make()
                    ->addEntry("sum", "Widget.topBarBasketValuesSum")
                    ->addEntry("quantity", "Widget.topBarBasketValuesQuantity")
                    ->addEntry("both", "Widget.topBarBasketValuesBoth")
                    ->toArray()
            );

        return $settingsFactory->toArray();
    }
}
