<?php

namespace App\Transformers;

class JobTransformer extends Transformer
{
    
    public function transform($job)
    {
        return [
            'category_id' => $job['category_id'],
            'seller_id' => $job['seller_id'],
            'title' => $job['title'],
            'description' => $job['description'],
            'approval_code' => $job['approval_code'],
            'is_accept_appointment' => $job['is_accept_appointment'] == 1 ? true : false,
            'is_freezed' => $job['is_freezed'] == 1 ? true : false,
            'photo1_url' => config('app.url') . '/files/' . $job['photo1_path'],
            'photo2_url' => config('app.url') . '/files/' . $job['photo2_path'],
            'photo3_url' => config('app.url') . '/files/' . $job['photo3_path'],
            'photo4_url' => config('app.url') . '/files/' . $job['photo4_path'],
            'amount' => $job['amount'],
            'minutes' => $job['minutes'],
            'areas' => array_pluck($job['job_area_ids'], 'area_id'),
            'average_rating' => $job['cached_rate_average'],
            'count_rating' => $job['cached_rate_count'],
            'created_at' => $job['created_at'],
            'updated_at' => $job['updated_at'],
        ];
    }
}