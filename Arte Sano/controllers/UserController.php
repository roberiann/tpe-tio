<?php

require_once "./views/UserView.php";
require_once "./models/UserModel.php";

class UserController{
// defino las variables privadas
    private $view;
    private $model;

    function __construct(){
        $this->view = new UserView();
        $this->model = new UserModel();

    }
// defino la funcion login
    function Login(){

        $this->view->ShowLogin();

    }
// defino la funcion logout
    function Logout(){
        session_start();
        session_destroy();
        header("Location: ".LOGIN);

    }
// defino la funcion verifiuser
    function VerifyUser(){
        $user = $_POST["input_user"];
        $pass = $_POST["input_pass"];

        if(isset($user)){
            $userFromDB = $this->model->GetUser($user);

            if(isset($userFromDB) && $userFromDB){
                // Existe el usuario

                if (password_verify($pass, $userFromDB->password)){

                    session_start();
                    $_SESSION["EMAIL"] = $userFromDB->email;
                    $_SESSION['LAST_ACTIVITY'] = time();

                    header("Location: ".BASE_URL."home");
                }else{
                    $this->view->ShowLogin("Contraseña incorrecta");
                }

            }else{
                // No existe el user en la DB
                $this->view->ShowLogin("El usuario no existe");
            }
        }
    }

}


?>