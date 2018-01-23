<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
		$head['title'] = lang('title_blog');
		$head['description'] = lang('description_blog');
        if (isset($_GET['find'])) {
            $find = $_GET['find'];
        } else {
            $find = null;
        }
        if (isset($_GET['tag'])) {
            $tag = $_GET['tag'];
        } else {
            $tag = null;
        }
        $rowscount = $this->PublicModel->articlesCount($find, $tag);
        $data['articles'] = $this->PublicModel->getArticles($this->num_rows, $page, $find, $tag);
        $data['links_pagination'] = pagination('blog', $rowscount, $this->num_rows);
        $data['tags'] = $this->PublicModel->getTags();
        $this->render('blog/index', $head, $data);
    }

    public function viewArticle($id)
    {
        $data = array();
        $head = array();
        $data['article'] = $this->PublicModel->getOneArticle($id);
        if ($data['article'] === null) {
            show_404();
        }
        $head['title'] = $data['article']['title'];
        $description = url_title(character_limiter(strip_tags($data['article']['description']), 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(' ', ',', $description);
        $this->render('blog/preview_article', $head, $data);
    }

}
