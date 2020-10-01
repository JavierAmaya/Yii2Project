<?php

namespace app\models;
use Yii;
use yii\base\model;

class ValidateForm extends model{
    // adding roles para los atributos
    
    public $nombre;
    public $email;

    public function rules(){
        return [
            ['nombre', 'required', 'message' => 'Campo requerido'],
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y maximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Solo se aceptan letras y numeros'],
            ['email', 'required', 'message' => 'Email requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Minimo 5 y maximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no valido']
        ];
    }

    public function attributeLabels(){
        return [
            'nombre' => 'Nombre:',
            'email' => 'Email'

        ];

    }

}
