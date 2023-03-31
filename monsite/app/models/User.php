<?php

class User{
    private $username;
    private $email;
    private $password;
    private $role;
    private $created_at;
    private $updated_at;
    private $connexion;

    public function __construct(){
        $this->connexion = new Database();
    }

    //cherche si il exite un user avec l'email passé en parametre et renvoie True ou False
    public function findUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email='" . $email. "'";
        $this->connexion->prepare($sql);
        $user = $this->connexion->resultSet();
        if(empty($user)){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //cherche si il existe un user avec l'email et password passé en parametre et renvoie l'user ou False
    public function login($email,$password){
        $sql = "SELECT * FROM users WHERE email='" . $email. "' and password ='".$password."'";
        $this->connexion->prepare($sql);
        $login = $this->connexion->single();
        if(empty($login)){
            return FALSE;
        }else{
            return $login;
        }

        // Avec le password haché
        /*if(empty($login)){
            return FALSE;
        }else{
            if(password_verify($password, $login['password'])){
                return $login;
            }else{
                return FALSE;
            }
        }*/
    }

    //cherche si il exite un user avec l'id et renvoie l'user ou False
    public function getUserByID($user_id){
        $sql = "SELECT * FROM users WHERE email='" . $user_id. "'";
        $this->connexion->prepare($sql);
        $user = $this->connexion->single();
        if(empty($user)){
            return FALSE;
        }else{
            return $user;
        }
    }

    //insere un nouveau user avec les données passées en parametre
    public function register($data){
        $sql = "insert into users(username,email,password,role) values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')";
        $this->connexion->prepare($sql);
        try{
            $this->connexion->execute($sql);
            return TRUE;
        }catch(Exception $e){
            return FALSE;
        };
    }
}