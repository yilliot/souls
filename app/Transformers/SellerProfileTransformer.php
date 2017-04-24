<?php

namespace App\Transformers;

class SellerProfileTransformer extends Transformer
{
    
    public function transform($seller)
    {
        return [
            'legal_id' => $seller['legal_id'],
            'legal_full_name' => $seller['legal_full_name'],
            'bank_acount_number' => $seller['bank_acount_number'],
            'bank_name' => $seller['bank_name'],
            'approval_code' => $seller['approval_code'],
            'legal_reject_code' => $seller['legal_reject_code'],
            'is_verified' => $seller['approval_code'] == 1 ? true : false,
        ];
    }
}