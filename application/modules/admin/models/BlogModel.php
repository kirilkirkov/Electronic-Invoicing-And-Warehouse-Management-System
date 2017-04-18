<?php

class BlogModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function postsCount($search = null)
    {
        if ($search !== null) {
            $this->db->like('blog_translates.title', $search);
        }
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id', 'left');
        $this->db->where('blog_translates.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('blog');
    }

    public function getPosts($lang = null, $limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(blog_translates.title LIKE '%$search%' OR blog_translates.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = $month['from'];
            $to = $month['to'];
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('blog_translates', 'blog_translates.for_id = blog.id', 'left');
        if ($lang == null) {
            $this->db->where('blog_translates.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        } else {
            $this->db->where('blog_translates.abbr', $lang);
        }
        $query = $this->db->select('blog.id, blog_translates.title, blog_translates.description, blog.url, blog.time, blog.image')->get('blog', $limit, $page);
        return $query->result_array();
    }

    public function deletePost($id)
    {
        $this->db->where('id', $id)->delete('blog');
        $this->db->where('for_id', $id)->delete('blog_translates');
    }

    public function getOnePost($id)
    {
        $array = array();
        $this->db->where('id', $id);
        $result = $this->db->get('blog');
        $array = $result->row_array();

        $this->db->where('for_id', $id);
        $result = $this->db->get('blog_translates');
        foreach ($result->result_array() as $row) {
            $array['translations'][$row['abbr']] = array(
                'title' => $row['title'],
                'description' => $row['description']
            );
        }
        return $array;
    }

    public function setPost($post)
    {
        if ($post['edit'] > 0) {
            $this->db->where('id', $post['edit']);
            $this->db->update('blog', array(
                'image' => $post['image'],
                'tags' => $post['tags']
            ));
            $insert_id = $post['edit'];
        } else {
            $this->db->insert('blog', array(
                'time' => time(),
                'tags' => $post['tags'],
                'image' => $post['image']
            ));
            $insert_id = $this->db->insert_id();
            $this->db->where('id', $insert_id);
            $this->db->update('blog', array('url' => str_replace(' ', '-', except_letters($post['title'][0])) . '_' . $insert_id));
        }
        $this->setEventTranslations($post, $insert_id);
    }

    private function setEventTranslations($post, $insert_id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if ($post['edit'] > 0) {
                $this->db->where('for_id', $insert_id);
                $this->db->where('abbr', $abbr);
                $this->db->update('blog_translates', array(
                    'title' => $post['title'][$i],
                    'description' => $post['description'][$i]
                ));
            } else {
                $this->db->insert('blog_translates', array(
                    'title' => $post['title'][$i],
                    'description' => $post['description'][$i],
                    'abbr' => $abbr,
                    'for_id' => $insert_id
                ));
            }
            $i++;
        }
    }

}
