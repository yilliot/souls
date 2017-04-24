<?php

namespace App\Transformers;


abstract class Transformer
{
    public function transformCollection(Array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public function transformCollectionPaginate(Array $paginate)
    {
        $paginate['data'] = array_map([$this, 'transform'], $paginate['data']);
        return $paginate;
    }

    public abstract function transform($item);
}