<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\ShortLink;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Контроллер коротких ссылок
 */
class ShortLinkController {
    public function actionIndex()
    {
        $model = new ShortLink();

        if (Yii::$app->request->isPost) {
            $originalUrl = Yii::$app->request->post('original_url');

            // Генерация токена
            $token = ShortLink::generateToken();

            $model->token = $token;
            $model->original_url = $originalUrl;
            $model->created_at = time();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Сокращенная ссылка: <a href='/$token' target='_blank'>/$token</a>");
                return $this->refresh();
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionRedirect($token)
    {
        $cacheKey = 'short_link_' . $token;
        $url = Yii::$app->cache->get($cacheKey);

        if ($url === false) {
            $link = ShortLink::findOne(['token' => $token]);
            if (!$link) {
                throw new NotFoundHttpException('Ссылка не найдена.');
            }
            $url = $link->original_url;
            Yii::$app->cache->set($cacheKey, $url, 3600); // Кэшируем на 1 час
        }

        return $this->redirect($url);
    }
}