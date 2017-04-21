<?php
namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

abstract class ApiBaseController extends Controller
{
    use Helpers;
}