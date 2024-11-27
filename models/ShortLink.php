<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class ShortLink extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%short_links}}';
    }

    public function rules()
    {
        return [
            [['token', 'original_url'], 'required'],
            [['original_url'], 'string', 'max' => 2048],
            [['token'], 'string', 'max' => 5],
            [['token'], 'unique'],
        ];
    }

    /**
     * Генерация токена короткой ссылки
     *
     * @param $length
     * @return string
     * @throws \Random\RandomException
     */
    public static function generateToken($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-';
        $maxIndex = strlen($characters) - 1;
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, $maxIndex)];
        }
        return $token;
    }
}
