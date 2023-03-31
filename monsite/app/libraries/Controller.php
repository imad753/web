<?php

abstract class Controller{             
    //Le controller charge et instancie un modèle de données 

    public function Model(string $model){ //chargement et instanciation du modèle de données
        
        require_once(APP_ROOT . 'models/' . $model . '.php'); //chargement du modèle 
        $this->$model = new $model();                     //instanciation du modèle
    }

    public function view($vue, array $data = []){   //chargement de la vue
        if(!empty($data)){
            extract($data);
        }

        ob_start();
        //var_dump($articles);
        require_once(APP_ROOT . 'views/' . strtolower(get_class($this)) . '/' . $vue . '.php');//Notons que la vue est déjà capable d'accéder aux données
        $content = ob_get_clean();
    }


}
