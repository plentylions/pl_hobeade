<?php

namespace HobeaDe\Widgets;

use HobeaDe\Widgets\Header\TopBarWidget;

class WidgetCollection
{

    const HEADER_WIDGETS = [
        TopBarWidget::class
    ];

    public static function all()
    {
        return array_merge(
            self::HEADER_WIDGETS,
            []
        );
    }

}
