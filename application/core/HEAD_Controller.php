<?php

class HEAD_Controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * They are not so many.. 
     * I will load all of bunch
     */

    private function loadTexts()
    {
        $vars = array();
        $arrayTexts = $this->PublicModel->getTexts();
        foreach ($arrayTexts as $text) {
            $vars[$text['my_key']] = $text['text'];
        }
        $this->load->vars($vars);
    }

}
