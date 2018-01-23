<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class BlogPublish extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('BlogModel', 'LanguagesModel'));
    }

    public function index($id = 0)
    {
        if (isset($_POST['title'])) {
            $this->addPost();
        }

        if ($id > 0) {
            $_POST = $this->BlogModel->getOnePost($id);
            $_POST['update'] = $id;
        }
        $data = array();
        $head = array();
        $data['id'] = $id;
        $head['title'] = 'Administration - Publish Blog Post';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['languages'] = $this->LanguagesModel->getLanguages();
        $this->render('blog/blogpublish', $head, $data);
        $this->saveHistory('Go to Blog Publish');
    }

    private function addPost()
    {
        $img = uploader('./attachments/blogimages/');
        if ($img !== false) {
            $_POST['image'] = $img;
        } else {
            $_POST['image'] = @$_POST['old_image'];
        }
        $this->BlogModel->setPost($_POST);
        redirect('admin/blog');
    }

}
