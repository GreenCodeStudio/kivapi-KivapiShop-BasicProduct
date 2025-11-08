<?php

namespace KivapiShop\BasicProduct\Components\ProductList;

use Core\ComponentManager\ComponentController;
use Core\Routing\RouteHelper;
use KivapiShop\BasicProduct\Repository\ProductRepository;

class Controller extends ComponentController
{
    public function __construct($params)
    {
        parent::__construct();
        $this->list = (new ProductRepository())->getAll();
        $this->productUrl=(new RouteHelper())->reverseRoute('KivapiShop\BasicProduct', 'Product');
    }

    public static function DefinedParameters()
    {
        return [
        ];
    }

    public function loadView()
    {
        include __DIR__.'/View.php';
    }
}
