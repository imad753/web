<?php
    require_once(APP_ROOT.'/libraries/Controller.php');
class Users extends Controller{
    private $usrModel;

    public function __construct(){
        $this->usrModel=$this->Model("User");
    }

    public function login(){
        $email=$_POST['email'] ;
        $password=$_POST['password'] ;

        if(!($this->User->login($email,$password))){
            return FALSE;
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            return TRUE;
        }
        
    }

    public function register(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $name = $_POST['name'];
        $error = False;

        if(empty($email)){
            $email_error='Veuiller remplir votre email';
            $error = True;
        }else if(!($this->User->findUserByEmail($email))){
            $email_error='Email déjà utiliser';
            $error = True;
        }

        if(empty($password)){
            $password_error='Veuiller remplir votre password';
            $error = True;
        }

        if(empty($confirm_password)){
            $confirm_password_error='Veuiller remplir votre confirm password';
            $error = True;
        }else if($confirm_password!=$password){
            $confirm_password_error='Confirm password different de password';
            $error = True;
        }

        if(empty($name)){
            $name_error='Veuiller remplir votre name';
            $error = True;
        }

        $password =password_hash($password,PASSWORD_DEFAULT);
        $data = array(
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'confirm_password' => $confirm_password,
            'email_error' => $email_error,
            'password_error' => $password_error,
            'confirm_password_error' => $confirm_password_error,
            'name_error' => $name_error,
        );

        if($error){
            $this->view('register',$data);
        }else{
            $this->view('login',NULL);
        }

    }
}