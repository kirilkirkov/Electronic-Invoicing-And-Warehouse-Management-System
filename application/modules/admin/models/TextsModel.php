<?php

class TextsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addText($post)
    {
        $this->db->insert('texts', array(
            'admin_info' => $post['admin_info'],
            'my_key' => $post['my_key']
        ));
        $insert_id = $this->db->insert_id();
        $this->setTextTranslations($post, $insert_id);
    }

    private function setTextTranslations($post, $insert_id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if (!$this->db->insert('texts_translates', array(
                        'text' => $post['text'][$i],
                        'abbr' => $abbr,
                        'for_id' => $insert_id
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $i++;
        }
    }

    public function getTexts()
    {
        $array = array();
        $result = $this->db->get('texts');
        foreach ($result->result_array() as $text) {
            $this->db->where('for_id', $text['id']);
            $result1 = $this->db->get('texts_translates');
            foreach ($result1->result_array() as $row) {
                $array[$text['my_key']]['translations'][$row['abbr']] = $row['text'];
                $array[$text['my_key']]['info'] = $text['admin_info'];
                $array[$text['my_key']]['id'] = $text['id'];
            }
        }
        return $array;
    }

    public function editText($post)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if (!$this->db->where('abbr', $abbr)->where('for_id', $post['edit_id'])->update('texts_translates', array(
                        'text' => $post['text_e'][$i]
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $i++;
        }
    }

    // QUESTIONS

    public function getQuestions()
    {
        $this->db->order_by('position', 'asc');
        $this->db->where('abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->select('questions.id, questions.position, questions_translates.question, questions_translates.answer');
        $this->db->join('questions_translates', 'questions_translates.for_id = questions.id');
        $result = $this->db->get('questions');
        return $result->result_array();
    }

    public function addQuestion($post)
    {
        if ($post['edit'] > 0) {
            if (!$this->db->where('id', $post['edit'])->update('questions', array(
                        'position' => $post['position']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $insert_id = $post['edit'];
        } else {
            if (!$this->db->insert('questions', array(
                        'position' => $post['position']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $insert_id = $this->db->insert_id();
        }
        $this->setQuestionTranslations($post, $insert_id);
    }

    private function setQuestionTranslations($post, $insert_id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if ($post['edit'] > 0) {
                if (!$this->db->where('abbr', $abbr)->where('for_id', $insert_id)->update('questions_translates', array(
                            'question' => $post['question'][$i],
                            'answer' => $post['answer'][$i]
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                    show_error(lang('database_error'));
                }
            } else {
                if (!$this->db->insert('questions_translates', array(
                            'question' => $post['question'][$i],
                            'answer' => $post['answer'][$i],
                            'abbr' => $abbr,
                            'for_id' => $insert_id
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                    show_error(lang('database_error'));
                }
            }
            $i++;
        }
    }

    public function getQuestion($id)
    {
        $array = array();
        $this->db->where('id', $id);
        $result = $this->db->get('questions');
        $array = $result->row_array();

        $this->db->where('for_id', $id);
        $result = $this->db->get('questions_translates');
        foreach ($result->result_array() as $row) {
            $array['translations'][$row['abbr']] = array(
                'question' => $row['question'],
                'answer' => $row['answer']
            );
        }
        return $array;
    }

    public function deleteQuestion($id)
    {
        if (!$this->db->where('id', $id)->delete('questions')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        if (!$this->db->where('for_id', $id)->delete('questions_translates')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
