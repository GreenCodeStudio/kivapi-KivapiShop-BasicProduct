<?php

namespace KivapiShop\BasicProduct\Components\ProductList;

use Core\ComponentManager\ComponentController;
use Core\Routing\RouteHelper;
use KivapiShop\BasicProduct\Repository\ProductRepository;

class Controller extends ComponentController
{
    public array $list;
    public $productUrl;
    public \Closure $formatCurrency;
    public string $productPath;

    public function __construct($params)
    {
        parent::__construct();
        $this->formatCurrency = function ($amount) {
            return number_format($amount / 100, 2, ',', ' ');
        };
        $this->list = (new ProductRepository())->getAll();
        $this->productUrl=(new RouteHelper())->reverseRoute('KivapiShop\BasicProduct', 'Product');
        $this->productPath = $this->productUrl->path;
    }

    public static function DefinedParameters()
    {
        return [
        ];
    }

    public function loadView()
    {
        $this->loadMPTS(__DIR__.'/View.mpts');
    }
}
