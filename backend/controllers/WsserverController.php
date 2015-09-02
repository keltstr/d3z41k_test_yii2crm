<?php

namespace backend\controllers;

use Yii;
use backend\models\Wsserver;


class WsserverController extends \yii\web\Controller
{

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionSwitchon()
	{
		$model = new Wsserver();
		$model->swt = 1;
		return $this->render('index', [
                'model' => $model,
            ]);
	}

	public function actionSwitchoff()
	{
		$model = new Wsserver();
		$model->swt = 0;
		return $this->render('index', [
                'model' => $model,
            ]);
	}
}

/*	{
		$model = new Wsserver();
		Yii::$app->db->createCommand()->delete('wsserver', [
        'switch' => 1 ])->execute();
		 Yii::$app->db->createCommand()->insert('wsserver', [
                'switch' => '0'] )->execute();
		return $this->render('index', [
                'model' => $model,
            ]);
	}*/
