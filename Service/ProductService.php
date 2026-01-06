<?php

namespace KivapiShop\BasicProduct\Service;

use KivapiShop\BasicProduct\Repository\ProductRepository;
use SimpleXMLElement;

class ProductService
{
    private ProductRepository $defaultDB;

    public function __construct()
    {
        $this->defaultDB = new ProductRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function getById(int $id)
    {
        return $this->defaultDB->getById($id);
    }

    public function insert($data)
    {
        $id = $this->defaultDB->insert(['stamp' => new \DateTime()]);
        $filtered = $this->filterData($data);
        $filtered['is_active'] = true;
        $this->defaultDB->insertVersion($id, $filtered);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['name'] = $data->name;
        $ret['price'] = $data->price;
        $ret['price_currency'] = $data->priceCurrency;
        $ret['description'] = $data->description;
        $ret['stamp'] = new \DateTime();
        $ret['photos'] = json_encode($data->photos);
        return $ret;
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $filtered['is_active'] = true;
        $versionId = $this->defaultDB->insertVersion($id, $filtered);
        $this->defaultDB->setCurrentVersion($id, $versionId);
    }

    public function getRss(): SimpleXMLElement
    {
        header('content-type: text/xml');
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]";
        $xml = new SimpleXMLElement('<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"/>');
        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Product Feed');
        $channel->addChild('link', $baseUrl.'/');
        $channel->addChild('description', 'Product feed for Google Merchant');
        $allProducts = $this->defaultDB->getAll();
        foreach ($allProducts as $product) {
            $item = $channel->addChild('item');
            $item->addChild('g:id', $product->id);
            $item->addChild('g:title', $product->name);
//            $item->addChild('g:description', $product->description);
            $item->addChild('g:link', $baseUrl.'/product?id='.$product->id);
            $item->addChild('g:price', $product->price.' '.$product->price_currency);
            if (!empty($product->photos[0])) {
                $item->addChild('g:image_link', $baseUrl.'/file/'.$product->photos[0]->id);
            }
        }
        return $xml;
    }
}
