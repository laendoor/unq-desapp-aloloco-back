<?php

namespace App\Api\Controllers;

/**
 * Class ProductsController
 * @package App\Api\Controllers
 */
class ProductsController extends ApiBaseController
{
    public function index() {
        $products = [
            [
                "id" => 1,
                "name" => "Papas Fritas",
                "brand" => "Lays",
                "price" => "20",
                "image" => "http://2.bp.blogspot.com/_tQVckLGToNA/TB_rn9LxlZI/AAAAAAAAEjk/mpV31bXbmgU/s1600/LAYS_Classic.gif",
            ], [
                "id" => 2,
                "name" => "Papas Fritas",
                "brand" => "Lays",
                "price" => "20",
                "image" => "http://2.bp.blogspot.com/_tQVckLGToNA/TB_rn9LxlZI/AAAAAAAAEjk/mpV31bXbmgU/s1600/LAYS_Classic.gif",
            ], [
                "id" => 3,
                "name" => "Papas Fritas",
                "brand" => "Lays",
                "price" => "20",
                "image" => "http://2.bp.blogspot.com/_tQVckLGToNA/TB_rn9LxlZI/AAAAAAAAEjk/mpV31bXbmgU/s1600/LAYS_Classic.gif",
            ]
        ];
        return $this->response->array($products);
    }
}