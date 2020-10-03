<?php

namespace app\models;
use Yii;
use yii\base\model;

class ValidarFormularioAjax extends model{
    // adding roles para los atributos ---- validacion del lado del servidor
    
    public $nombre;
    public $email;

    public function rules(){
        return [
            ['nombre', 'required', 'message' => 'Campo requerido'],
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y maximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Solo se aceptan letras y numeros'],
            ['email', 'required', 'message' => 'Email requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Minimo 5 y maximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no valido'],
            ['email', 'email_existe']
        ];
    }

    public function attributeLabels(){
        return [
            'nombre' => 'Nombre:',
            'email' => 'Email'

        ];

    }


    public function email_existe($attribute, $params){
        $email = ["manuel@gmail.com","antonio@gmail.com"];

        foreach ($email as $value) {
            if ($this->email == $value) {
                $this->addError($attribute,"El email existe");
                return true;
            }else {
                return false;
            }
        }
    }

}
