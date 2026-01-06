<?php

namespace KivapiShop\BasicProduct\Panel\StandardControllers;

use Core\Panel\Authorization\Authorization;
use Core\Panel\Infrastructure\PanelStandardController;
use KivapiShop\BasicProduct\Service\ProductService;
use SimpleXMLElement;

class ProductExportStandardController extends PanelStandardController
{
    public function GoogleMerchant()
    {
        $xml = (new ProductService())->getRss();
        echo $xml->asXML();
        exit;
    }

    public function hasPermission()
    {
        return true;
    }
}
