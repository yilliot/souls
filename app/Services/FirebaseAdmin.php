<?php

namespace App\Services;

use Firebase\JWT\JWT;

class FirebaseAdmin
{
    public function create_custom_token($uid, $is_premium_account)
    {
      $service_account_email = config('firebase.service_account_email');
      $private_key = config('firebase.private_key');

      $now_seconds = time();
      $payload = array(
        "iss" => $service_account_email,
        "sub" => $service_account_email,
        "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
        "iat" => $now_seconds,
        "exp" => $now_seconds+(60*60),  // Maximum expiration time is one hour
        "uid" => $uid,
        "claims" => array(
          "premium_account" => $is_premium_account
        )
      );
      // $pub_key = openssl_pkey_get_private($private_key);
      // $keyData = openssl_pkey_get_details($pub_key);
      // return JWT::decode($payload, $keyData['key'], array('RS256'));
      return JWT::encode($payload, $private_key);
    }

}