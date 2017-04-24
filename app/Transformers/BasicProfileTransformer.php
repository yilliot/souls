<?php

namespace App\Transformers;

class BasicProfileTransformer extends Transformer
{
    
    public function transform($user)
    {
        return [
            'email' => $user['is_fbauth_only'] ? null : ($user['email']),
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'phone' => $user['phone'],
            'is_email_verified' => (boolean) $user['is_email_verified'],
        ];
    }
}