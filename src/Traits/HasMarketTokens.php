<?php

namespace VanLaravelPlugin\Traits;

use Exception;
use VanLaravelPlugin\Support\Config;

trait HasMarketTokens
{
    /**
     * @throws Exception
     */
    public function ensure_api_token_is_available(): void
    {
        if (! Config::get('token')) {
            throw new Exception("Please authenticate using the 'login' command before proceeding.");
        }
    }
}
