<?php

class Core{
    protected $currentController = 'page';
    protected $currentMethod = 'index';
    protected $params=[];

    public function __construct(){
        $url = $this->getUrl();

        $this->params=$url?array_values($url):[];
    }

    public function getUrl(){
        $url = $_GET['url'];

        $url=trim($url);

        $url = explode($url,'/');

        return $url;

    }

}