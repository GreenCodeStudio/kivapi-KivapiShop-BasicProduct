<?php
namespace KivapiShop\BasicProduct\Panel\Ajax;

use Core\Panel\Infrastructure\PanelAjaxController;
use CoreLib\Article\Service\ArticleService;
use KivapiShop\BasicProduct\Service\ProductService;

class BasicProductAjaxController extends PanelAjaxController
{
    public function getTable($options)
    {
        $this->will('KivapiShop_BasicProduct', 'show');
        $service = new ProductService();
        return $service->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('KivapiShop_BasicProduct', 'edit');
        $service = new ProductService();
        $service->update($data->id, $data);
    }

    public function insert($data)
    {
        $this->will('KivapiShop_BasicProduct', 'add');
        $service = new ProductService();
        $id = $service->insert($data);
    }
}
