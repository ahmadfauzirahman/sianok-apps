<?php

namespace app\components;

abstract class AuthAbstract implements AuthInterface
{
    /**
     * pendefinisian aturan dan hak akses (permission/izin)
     *
     * @var array $roles
     */
    protected static $roles = [];

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return self::$roles;
    }

    /**
     * @param array $roles
     */
    public static function setRoles(array $roles): void
    {
        self::$roles = $roles;
    }
}
