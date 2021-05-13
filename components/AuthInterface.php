<?php

namespace app\components;

interface AuthInterface
{
    /**
     * Periksa authorization
     *
     * @param $user
     * @param $action
     * @return bool
     */
    public static function authorization($action, $user = null);

    /**
     * handle all behaviors of controller class
     *
     * @param $params
     * @return array
     */
    public static function behaviors($params);
}
