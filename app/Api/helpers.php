<?php

use Dingo\Api\Routing\UrlGenerator;

function apiRoute($name, array $params = [], $v = 'v1')
{
return app(UrlGenerator::class)->version($v)->route($name, $params);
}
