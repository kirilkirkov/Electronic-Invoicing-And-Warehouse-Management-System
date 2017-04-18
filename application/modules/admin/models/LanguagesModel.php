<?php

class LanguagesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLanguages()
    {
        $query = $this->db->query('SELECT * FROM languages');
        return $query;
    }

}
