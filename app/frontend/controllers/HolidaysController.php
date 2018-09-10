<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use app\models\Holidays;
use app\models\HolidaysSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\RolesHelper;

/**
 * HolidaysController implements the CRUD actions for Holidays model.
 */
class HolidaysController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                      [
                        'actions' => ['index', 'create', 'update', 'approve'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Holidays models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HolidaysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Holidays model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Holidays();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Отпуск успешно добавлен');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Holidays model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->identity->getId() || $model->approved !== Holidays::HOLIDAY_NOT_APPROVED) {
            $this->redirect('index');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Даты отпусков успешно обновлены');
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Holidays model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     *
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== Yii::$app->user->getId() || !RolesHelper::isAdmin()) {
            return $this->redirect('index');
        }
        $model->delete();
        Yii::$app->session->setFlash('success', 'Отпуск успешно удален');
        return $this->redirect(['index']);
    }

    /**
     * Обновляет статуст подтверждения у отпуска
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if (!RolesHelper::isAdmin() || $model->approved !== 1) {
            $this->redirect('index');
        }

        $model->approved = Holidays::HOLIDAY_APPROVED;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Отпуск одобрен');
            return $this->redirect('index');
        }
        return Yii::$app->session->setFlash('error', 'Не удалось одобрить отпуск');
    }

    /**
     * Finds the Holidays model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Holidays the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Holidays::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена');
    }
}
