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

    public function checkUserFreeEmail($email)
    {
        $this->db->where('enabled', 1);
        $this->db->where('email', $email);
        $num = $this->db->count_all_results('users');
        if ($num > 0) {
            return lang('registered_by_user');
        }
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

    public function getTexts()
    {
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->join('texts_translates', 'texts_translates.for_id = texts.id');
        $result = $this->db->get('texts');
        return $result->result_array();
    }

    public function getQuestions()
    {
        $this->db->order_by('position', 'asc');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->select('questions.id, questions.position, questions_translates.question, questions_translates.answer');
        $this->db->join('questions_translates', 'questions_translates.for_id = questions.id');
        $result = $this->db->get('questions');
        return $result->result_array();
    }

    public function registerUser($post)
    {
        $result = $this->db->insert('users', array(
            'email' => $post['email'],
            'password' => md5salt($post['password']),
            'time_registered' => time()
        ));
        $user_id = $this->db->insert_id();
        $this->insertOptionsTables($user_id);
        if ($result == true) {
            return $post['email'];
        }
        return false;
    }

    /*
     * Default system options tables for every user
     */

    private function insertOptionsTables($user_id)
    {
        $this->db->query('INSERT INTO users_invoices_options (for_user, opt_inv_roundTo) VALUES (' . $user_id . ', 2)');
    }

    public function getUserInfoFromEmail($email)
    {
        $this->db->where('enabled', 1);
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        return $result->row_array();
    }

    public function loginCheck($post)
    {
        $this->db->where('enabled', 1);
        $this->db->where('email', $post['email']);
        $this->db->where('password', md5salt($post['password']));
        $num = $this->db->count_all_results('users');
        if ($num > 0) {
            return true;
        }
        return false;
    }

    public function getUserInvoicesOptions()
    {
        $this->db->select('opt_inv_roundTo');
        $this->db->limit(1);
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_invoices_options');
        return $result->row_array();
    }

}
