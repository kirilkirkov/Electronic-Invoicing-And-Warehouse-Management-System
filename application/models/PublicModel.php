<?php

class PublicModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOneLanguage($myLang)
    {
        $this->db->select('*');
        $this->db->where('abbr', $myLang);
        $result = $this->db->get('languages');
        return $result->row_array();
    }

    public function lastInBlog($limit)
    {
        $this->db->limit($limit);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('blog');
        return $query->result_array();
    }

}
