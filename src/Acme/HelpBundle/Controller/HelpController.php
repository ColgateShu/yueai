<?php

namespace Acme\HelpBundle\Controller;

use Predis\Client;

class HelpController
{
    public $redis;

    /**
     * HelpController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param Client $redis
     */
    public function setRedis(Client $redis)
    {
        $this->redis || $this->redis = $redis;
    }

    /**
     * @param String $key
     * @param $data
     * @param Int $timestamp
     * @return mixed
     */
    public function saveRedis(String $key, $data, Int $timestamp = 120)
    {
        if (is_string($data)) {
            $get_method = 'get';
            $set_method = 'set';
        } elseif (is_array($data)) {
            $get_method = 'hgetall';
            $set_method = 'hmset';
        } else {
            $get_method = 'get';
            $set_method = 'set';
        }

        $old_data = call_user_func_array([$this->redis, $get_method], [$key]);
        if (is_array($data)) {
            $new_data = array_merge((array)$old_data, (array)$data);
        } else {
            $new_data = $data;
        }
        $res = call_user_func_array([$this->redis, $set_method], [$key, $new_data]);
        $this->setRedisTimeout($key, $timestamp);
        return $res;
    }

    public function setRedisTimeout(String $key, Int $timestamp)
    {
        return $this->redis->expire($key, $timestamp);
    }
}
