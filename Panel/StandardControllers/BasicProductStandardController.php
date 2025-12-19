<?php

namespace KivapiShop\BasicProduct\Panel\StandardControllers;

use Authorization\Permissions;
use Core\ComponentManager\Page;
use Core\Exceptions\NotFoundException;
use Core\Panel\Infrastructure\PanelStandardController;
use CoreLib\Article\Service\ArticleService;
use KivapiShop\BasicProduct\Service\ProductService;

class BasicProductStandardController extends PanelStandardController
{

    function index()
    {
        $this->will('KivapiShop_BasicProduct', 'show');
        $this->addView('KivapiShop/BasicProduct', 'ProductList');
        $this->pushBreadcrumb(['title' => 'Product', 'url' => '/panel/Package/KivapiShop/BasicProduct/BasicProduct']);

    }

    function edit(int $id)
    {
        $this->will('KivapiShop_BasicProduct', 'edit');
        $this->addView('KivapiShop/BasicProduct', 'ProductEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'Product', 'url' => '/panel/Package/KivapiShop/BasicProduct/BasicProduct']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/panel/Package/KivapiShop/BasicProduct/BasicProduct/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('KivapiShop_BasicProduct', 'edit');
        $service = new ProductService();
        $data = $service->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['Product' => $data];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('KivapiShop_BasicProduct', 'add');
        $this->addView('KivapiShop/BasicProduct', 'ProductEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'Article', 'url' => '/panel/Package/KivapiShop/BasicProduct/BasicProduct']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/panel/Package/KivapiShop/BasicProduct/BasicProduct/add']);
    }

}
