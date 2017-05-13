<?php

use Dingo\Api\Routing\UrlGenerator;

/**
 * Create api route
 *
 * @param $name
 * @param array $params
 * @param string $version
 * @return string
 */
function apiRoute($name, array $params = [], $version = 'v1'): string {
    return app(UrlGenerator::class)
        ->version($version)
        ->route($name, $params);
}
