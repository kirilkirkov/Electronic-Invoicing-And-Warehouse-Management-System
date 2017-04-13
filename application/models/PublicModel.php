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
        $this->db->order_by('blog.id', 'desc');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id');
        $query = $this->db->get('blog');
        return $query->result_array();
    }

    public function checkFreeEmail($email)
    {
        /*
          $this->db->where('email', $email);
          $num = $this->db->count_all_results('users');
          if ($num > 0) {
          return lang('registered_by_user');
          }

          $this->db->where('email', $email);
          $num2 = $this->db->count_all_results('team_members');
          if ($num2 > 0) {
          return lang('registered_by_member');
          }
         * */
        return true;
    }

    public function articlesCount($find = null, $tag = null)
    {
        if ($find != null) {
            $this->db->like('title', $find);
        }
        if ($tag != null) {
            $this->db->like('tags', $tag);
        }
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id');
        return $this->db->count_all_results('blog');
    }

    public function getArticles($limit = null, $start = null, $find = null, $tag = null)
    {
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        if ($find != null) {
            $this->db->like('title', $find);
        }
        if ($tag != null) {
            $this->db->like('tags', $tag);
        }
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->order_by('blog.id', 'DESC');
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id');
        $query = $this->db->get('blog');
        return $query->result_array();
    }

    public function getTags()
    {
        $str = null;
        $query = $this->db->select('tags')
                ->limit(5)
                ->order_by("id", "random")
                ->get('blog');
        foreach ($query->result_array() as $val) {
            $str .= ',' . implode(',', $val);
        }
        return $str;
    }

    public function getOneArticle($id)
    {
        $this->db->where('blog.id', $id);
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id');
        $query = $this->db->get('blog');
        return $query->row_array();
    }

    public function getFeatures()
    {
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->join('features_translates', 'features_translates.for_id = features.id');
        $query = $this->db->get('features');
        return $query->result_array();
    }

}
