<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $userID
 * @property string $username
 * @property string $password
 * @property string $nama
 * @property string $email
 * @property string $telepon
 * @property string $role
 *
 */
class User extends \yii\web\User
{

}
