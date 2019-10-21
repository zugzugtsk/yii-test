<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
// Модель пользователей и формы регистрации
use app\models\User;
use app\models\SignupForm;
// Модель объявлений и формы их создания/изменения
use app\models\Message;
use app\models\MessageForm;
// Модели городов и категорий
use app\models\City;
use app\models\Category;
// Постраничеый вывод записей
use yii\data\Pagination;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $query = Message::find();
      $pages = new Pagination(['totalCount' => $query->count()]);
      $messages = $query->offset($pages->offset)
      ->limit($pages->limit)
      ->all();
      return $this->render('messagelist', compact('messages','pages'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
    * Signup action for unauthorized User
    */
    public function actionSignup()
    {
    $model = new SignupForm();

    if ($model->load(Yii::$app->request->post())) {
        if ($user = $model->signup()) {
            if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }
        }
    }

    return $this->render('signup', [
        'model' => $model,
        ]);
    }


    public function actionAddMessage(){
      // Получаем списки категорий и городов:
      $cats = Category::find()->all();
      $cities = City::find()->all();
      // Creating message instance
      $message = new MessageForm();
      if ($message->load(Yii::$app->request->post())){
        if ($message->save()){
          Yii::$app->session->setFlash('success', 'Объявление добавлено');
          return $this->refresh();
        } else {
          Yii::$app->session->setFlash('error', 'Операция не удалась...');
        }
      }

      $this->view->title = 'Добавить объявление';
      return $this->render('message' , compact('message','cats','cities'));
    }


    public function actionProfile(){
      $cities = City::find()->all();
      $t = Yii::$app->user->getId();
      $user = User::findOne(['id' => $t]);

      if ($user->load(Yii::$app->request->post())){
        if ($user->save()){
          Yii::$app->session->setFlash('success', 'Профиль обновлен');
          return $this->refresh();
        } else {
          Yii::$app->session->setFlash('error', 'Операция не удалась...');
        }
      }

      return $this->render('profile', compact('user','cities'));
    }
    // //Добавим пользователя admin ручками. Вообще это исо страницы делается, но в качестве теста пойдет.
    // public function actionAddAdmin() {
    //     $model = User::find()->where(['username' => 'admin'])->one();
    //     if (empty($model)) {
    //         $user = new User();
    //         $user->username = 'admin';
    //         $user->email = 'admin@host.mail';
    //         $user->setPassword('admin');
    //         $user->generateAuthKey();
    //         if ($user->save()) {
    //             echo 'User admin successfuly added';
    //         }
    //     }
    // }

}
