<?php

class Database{
    private $stmt;

    protected $_connexion;

    public function __construct(){

        $this->_connexion = null;
        try{
            $this->_connexion = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASSWORD
            );

        } catch (PDOException $exception){
            echo "Err : " . $exception->getMessage();
        }
    }

    //preparer la requếte
    public function prepare($sql){
        $this->stmt = $this->_connexion->prepare($sql);
    }

    //execution de la requête
    public function executequery(){
        $this->stmt->execute();
    }

    //retourne une ligne du resultat
    public function single(){
        $this->executequery();
        return $this->stmt->fetch();
    }

    //retourne tous les resultats
    public function resultSet(){
        $this->executequery();
        return $this->stmt->fetchAll();
    }

    //retourne le nombre de ligne des resultats
    public function rowCount(){
        return mysql_num_rows($this->stmt->fetchAll());
    }

    //l'attribut id est en auto_increment, cet fonction retourne le dernier id ajouter
    public function lastInsertedId(){
        return $this->_connexion->lastInsertedId();
    }
}