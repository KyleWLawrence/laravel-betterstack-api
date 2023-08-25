<?php

namespace KyleWLawrence\BetterStack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \BetterStack\Api\HttpClient
 */
class BetterStack extends Facade
{
    /**
     * Return facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BetterStack';
    }
}
