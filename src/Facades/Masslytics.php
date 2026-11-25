<?php

namespace SwitchNetwork\Masslytics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SwitchNetwork\Masslytics\Masslytics
 */
class Masslytics extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SwitchNetwork\Masslytics\Masslytics::class;
    }
}
