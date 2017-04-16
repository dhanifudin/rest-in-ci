<?php

require_once APPPATH . 'libraries/JWT.php';

use \Firebase\JWT\JWT;

class Authorization
{
    public static function validateToken($token)
    {
        $CI =& get_instance();
        $key = $CI->config->item('jwt_key');
        $algorithm = $CI->config->item('jwt_algorithm');
        return JWT::decode($token, $key, array($algorithm));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        $key = $CI->config->item('jwt_key');
        $algorithm = $CI->config->item('jwt_algorithm');
        return JWT::encode($data, $key);
    }

    public static function tokenIsExist($headers)
    {
        return (array_key_exists('Authorization', $headers)
            && !empty($headers['Authorization']));
    }
}
