<?php

namespace KivapiShop\BasicProduct\Repository;

use Core\Database\DB;
use Core\Database\Repository;


class ProductRepository extends Repository
{
    public function getCurrentVersion(int $productId)
    {
        $version = DB::get("SELECT *,kbp.id as product_id, kbp.stamp as oryginalStamp FROM kshop_base_product kbp JOIN kshop_base_product_version kbpv ON kbpv.kshop_base_product_id = kbp.id AND kbpv.is_active WHERE kbp.id = ? ORDER BY kbpv.stamp DESC LIMIT 1", [$productId])[0] ?? null;
        return $version;
    }

//    public function getDataTable($options)
//    {
//        $start = (int)$options->start;
//        $limit = (int)$options->limit;
//        $sqlOrder = $this->getOrderSQL($options);
//        $rows = DB::get("SELECT a.*, v.title FROM article a JOIN article_version v ON v.article_id = a.id AND v.is_active $sqlOrder LIMIT $start,$limit");
//        $total = DB::get("SELECT count(*) as count FROM article")[0]->count;
//        return ['rows' => $rows, 'total' => $total];
//    }
//
//    private function getOrderSQL($options)
//    {
//        if (empty($options->sort))
//            return "";
//        else {
//            $mapping = [];
//            if (empty($mapping[$options->sort->col]))
//                throw new Exception();
//            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
//        }
//    }
//
//    public function getById(int $id)
//    {
//        return DB::get("SELECT *, a.id FROM article a JOIN article_version v ON v.article_id = a.id AND v.is_active WHERE a.id = ?", [$id])[0] ?? null;
//    }
//
    public function defaultTable(): string
    {
        return 'kshop_base_product';
    }
//
//    public function insertVersion(int $id, array $data)
//    {
//        $data['article_id'] = $id;
//        return DB::insert('article_version', $data);
//    }
//
//    public function setCurrentVersion(int $id, int $versionId)
//    {
//        DB::query("UPDATE article_version SET is_active = (id = ?) WHERE article_id = ?", [$versionId, $id]);
//    }
    public function getAll(){
        return DB::get("SELECT kbp.id, kbpv.name, kbpv.price, kbpv.price_currency
FROM kshop_base_product kbp
JOIN kshop_base_product_version kbpv on kbp.id = kbpv.kshop_base_product_id
WHERE kbpv.is_active");
    }
}
