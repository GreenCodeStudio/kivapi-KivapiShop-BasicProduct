<?php

namespace KivapiShop\BasicProduct\Components\Product;

use Core\ComponentManager\ComponentController;
use Core\Exceptions\NotFoundException;
use KivapiShop\BasicProduct\Repository\ProductRepository;

class Controller extends ComponentController
{
    private mixed $id;
    public $version;
    public \Closure $formatCurrency;

    public function __construct($params)
    {
        parent::__construct();
        $this->id = $params->id;
        $this->version = (new ProductRepository())->getCurrentVersion($params->id);
        if(empty($this->version)){
            throw new NotFoundException('Product not found');
        }
        $this->formatCurrency = function ($amount) {
            // zgodnie z poprzednim widokiem: przecinek jako separator dziesiętny, spacja tysięcy
            return number_format($amount / 100, 2, ',', ' ');
        };
    }

    public static function DefinedParameters()
    {
        return [
            'id' => (object)['Title' => 'Id', 'type' => 'int', 'canFromQuery' => true]
        ];
    }

    public function loadView()
    {
        $this->loadMPTS(__DIR__.'/View.mpts');
    }

}
