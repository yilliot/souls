<?php

namespace App\Transformers;

class CategoryTransformer extends Transformer
{
    
    public function transform($category)
    {
        return [
            'id' => $category['id'],
            'name' => $category['name'],
            'image_url' => config('app.url') . '/files/category/' .  $category['id'] . '.jpg',
        ];
    }
}