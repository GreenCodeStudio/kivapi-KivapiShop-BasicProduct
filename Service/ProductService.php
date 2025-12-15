<?php

namespace KivapiShop\BasicProduct\Service;

use KivapiShop\BasicProduct\Repository\ProductRepository;

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
        return $ret;
    }

    public function update(int $id, $data)
    {
        $filtered = $this->filterData($data);
        $filtered['is_active'] = true;
        $versionId = $this->defaultDB->insertVersion($id, $filtered);
        $this->defaultDB->setCurrentVersion($id, $versionId);
    }
}
