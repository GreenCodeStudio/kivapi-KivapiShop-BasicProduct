<?php

namespace KivapiShop\BasicProduct\Components\Product;

use Core\ComponentManager\ComponentController;
use Core\Exceptions\NotFoundException;
use KivapiShop\BasicProduct\Repository\ProductRepository;

class Controller extends ComponentController
{
    private mixed $id;
    private mixed $version;

    public function __construct($params)
    {
        parent::__construct();
        $this->id = $params->id;
        $this->version = (new ProductRepository())->getCurrentVersion($params->id);
        if(empty($this->version)){
            throw new NotFoundException('Product not found');
        }
    }

    public static function DefinedParameters()
    {
        return [
            'id' => (object)['Title' => 'Id', 'type' => 'int', 'canFromQuery' => true]
        ];
    }

    public function loadView()
    {
        include __DIR__.'/View.php';
    }

}
