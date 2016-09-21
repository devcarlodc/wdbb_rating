<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Rating;
use app\models\DeductibleRates;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays sample homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays Channel Wind Deductible Buy Back Rating Form
     *
     * @return string
     */
    public function actionRating()
    {
        $rating = new Rating;

        if($_POST) {
            $rating->attributes = $_POST['Rating'];

            if($rating->create()) {
                return $this->redirect('listing');
            }
        }

        return $this->render('rating', array(
            'rating' => $rating
        ));
    }

    /**
     * Lists all Rating Records
     *
     * @return string
     */
    public function actionListing()
    {
        $ratingDP = new ActiveDataProvider([
            'query' => Rating::find()->orderBy('id DESC'),
        ]);

        return $this->render('listing', array(
            'ratingDP' => $ratingDP
        ));
    }

    /**
     * Print the Deductible Percentage Rate for a WDBB Limit
     *
     * @return int (percentage rate)
     */
    public function actionDeductiblerate()
    {
        if(isset($_POST['limit'])) {
            $rate = DeductibleRates::determineRate($_POST['limit']);
            echo $rate->percentage;
        } else {
            echo 0;
        }

        exit;
    }

}
