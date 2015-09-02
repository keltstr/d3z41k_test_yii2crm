<?php

namespace frontend\controllers;

use Yii;
//use app\models\Wsclient;
use app\models\Clients;
use frontend\models\ClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;

/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class ClientsController extends Controller
{
    public function behaviors()
    {
        return [

        'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                   'actions' => ['index'],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                       return User::isUserUser(Yii::$app->user->identity->username);
                   }
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Clients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clients model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {	
		//$Wsclient = new Wsclient('vm12721.hv8.ru', 8000);
		//$Wsclient->sendData(Yii::$app->user->identity->username .' @ view | id = '. $id);
		//unset($Wsclient);
			
       Yii::$app->db->createCommand()->insert('user_log', [
        'user_name' => Yii::$app->user->identity->username,
        'type_event' => 'view', 
        'client_id' => $id ])->execute(); */

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clients();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
        //$Wsclient = new Wsclient('185.46.8.97', 8000);
		//$Wsclient->sendData(Yii::$app->user->identity->username .' @ create | id = '. //$model->id);
		//unset($Wsclient);
			
			Yii::$app->db->createCommand()->insert('user_log', [
                'user_name' => Yii::$app->user->identity->username,
                'type_event' => 'create', 
                'client_id' => $model->id])->execute(); 

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $n_name = $model->name;
        $n_surname = $model->surname;
        $n_email = $model->email;
        $n_age = $model->age;
        $n_born = $model->born;
		$message = '';
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

		/*$Wsclient = new Wsclient('185.46.8.97', 8000);
		
		if ($model->name != $n_name)
			$message .= '[name]';
		if ($model->surname != $n_surname)
			$message .='[surname]';
		if ($model->email != $n_email)
			$message .='[email]';
		if ($model->age != $n_age)
			$message .='[age]';
		if ($model->born != $n_born)
			$message .='[born]';*/
		
            ($model->name != $n_name) ? ($ch_name = true) : ($ch_name = 0);
            ($model->surname != $n_surname) ? ($ch_surname = true) : ($ch_surname = 0);
            ($model->email != $n_email) ? ($ch_email = true) : ($ch_email = 0);
            ($model->age != $n_age) ? ($ch_age = true) : ($ch_age = 0);
            ($model->born != $n_born) ? ($ch_born = true) : ($ch_born = 0);
			
		//$Wsclient->sendData(Yii::$app->user->identity->username .' @ update | id = '. //$model->id.' '.$message);
		//unset($Wsclient);	
			
            Yii::$app->db->createCommand()->insert('user_log', [
                'user_name' => Yii::$app->user->identity->username,
                'type_event' => 'update', 
                'client_id' => $id,
                'ch_name' => $ch_name,
                'ch_surname' => $ch_surname,
                'ch_email' => $ch_email,
                'ch_age' => $ch_age,
                'ch_born' => $ch_born,
                ] )->execute(); 
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Clients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		
		//$Wsclient = new Wsclient('185.46.8.97', 8000);
		//$Wsclient->sendData(Yii::$app->user->identity->username .' @ delete | id = '. $id);
		//unset($Wsclient);

        /Yii::$app->db->createCommand()->insert('user_log', [
        'user_name' => Yii::$app->user->identity->username,
        'type_event' => 'delete', 
        'client_id' => $id, ])->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}