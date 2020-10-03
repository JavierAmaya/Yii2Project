<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidateForm;
// se agregan los nuevos modelos a utilizar en nuestra vista 
use app\models\ValidarFormularioAjax;
// para trabajar con ajax es necesario añadir estos otros dos modelos 
use yii\widgets\ActiveForm;
//use yii\web\response;

class SiteController extends Controller
{
    //accion para crear 

    public function actionCreate(){
        return $this->render("create");
    }
    /**
     * {@inheritdoc}
     */
    public function actionSaluda($get = "Tutorial Yii"){
        
        $mensaje= "Hello World";
        $numeros= [3,4,5,3,4,5];
        return $this-> render ("saluda",
        [
            'saluda' => $mensaje,
            'array' => $numeros,
            'get' => $get
        ]);
        
    }

    public function actionFormulario($mensaje = null,$estado=null){
        return $this -> render("formulario",['mensaje'=>$mensaje,'estado'=>$estado]);

    }
 
    public function actionPrueba(){
        return $this->render("prueba");
    }
    
    public function actionRequest(){
        $mensaje = null;
        if (isset($_REQUEST['nombre'])) { ///isset comprueba si la variable esta null o vacia, y devuelve true or false
            $mensaje = "Bien, has enviado tu nombre: ".$_REQUEST['nombre']." y su correo es: ".$_REQUEST['correo'];
            $estado="entro al if";
        }
        $this-> redirect(["site/formulario","mensaje"=>$mensaje,"estado"=>$estado]);
    }
    public function actionValidateform(){
        $model = new ValidateForm;
        if ($model -> load (Yii::$app->request->post())) {
            if ($model -> validate()) {
                # ejemplo :consultar en una base de datos
            }else {
                $model -> getErrors();
            }
        }
        return $this-> render("validateform",['model' => $model]);
    }
    

    /// accion para validar el formulario atravez de ajax

    public function actionValidarformularioajax(){
        // agregando los modelos que se necesitan para hacerlo funcionar
        // se debe empezar agregando o creando la instancia del modelo

        $model = new ValidarFormularioAjax;
        $msg = null;

        // comprobar si los datos son enviados via ajax  
        //$model->load(Yii::$app->request->post()) --para comprobar que el metodo es post   //Yii::$app->request->isAjax --para comprobar que la peticion sea tipo ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {  
            Yii::$app->response->format = Response::FORMAT_JSON;   // para crear la respuesta en formato json 
            return ActiveForm::validate($model);   //validacion del formulario            
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // si la validacion del modelo es correcta // Ejemplo: hacer una consulta a una base de datos
                $msg="Enhorabuena , formulario enviado correctamente";
                $model->nombre = null;  // vaciando los datos, y es una forma de acceder a estos atributos
                $model->email = null; 
            }else {
                $model->getErrors();
            }
        }
        
        return $this-> render("validarformularioajax",['model'=>$model , 'msg'=>$msg]); //['model'=>.....] pasando el modelo y el mensaje a la vista

    }






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
        return $this->render('index');
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
