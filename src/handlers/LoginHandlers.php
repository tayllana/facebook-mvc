<?php
namespace src\handlers;
use \src\models\Usuario;

class LoginHandlers {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $_SESSION['usuario'] = Usuario::select()->where('token',$token)->one();
            if($_SESSION['usuario'] <= 0){
                $_SESSION['usuario'] = false;
            }
        }else{
            $_SESSION['usuario'] = false;
        }    
    }

    public static function verifyLogin($email, $password){
        $user = Usuario::select()->where('email',$email)->one();
        if($user){
            if(password_verify($password, $user['password'])){
                $token = md5(time().rand(0,9999).time());
                Usuario::update()->set('token', $token)->where('id', $user['id'])->execute();
                $_SESSION['usuario'] = $user;
                return $token; 
            }

        }
        return false;  
    }

    public static function emailExists($email){
        $user = Usuario::select()->where('email',$email)->one();
        return $user? true: false;
    }
    public static function insertUser($email, $nome, $password, $nascimento){
        $token = md5(time().rand(0,9999).time());
        try {
            Usuario::insert([
                'email' => $email, 
                'nome' => $nome, 
                'senha' => password_hash($password, PASSWORD_DEFAULT), 
                'aniversario' => $nascimento,
                'avatar' => 'default.jpg',
                'capa' => 'cover.jpg',
                'token' => $token
            ])->execute();
            return $token;
            // $user = Usuario::select()->where('email',$email)->one();
            // return $user->email;
        } catch (\Exception $e) {
            return "Erro ao inserir os dados: " . $e->getMessage();
        }
    }
    
}