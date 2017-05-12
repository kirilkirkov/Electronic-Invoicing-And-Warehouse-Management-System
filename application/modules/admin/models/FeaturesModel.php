<?php

class FeaturesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addFeature($post)
    {
        if ($post['edit'] > 0) {
            if (!$this->db->where('id', $post['edit'])->update('features', array(
                        'image' => $post['image']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $insert_id = $post['edit'];
        } else {
            if (!$this->db->insert('features', array(
                        'image' => $post['image']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
            $insert_id = $this->db->insert_id();
        }
        $this->setFeatureTranslations($post, $insert_id);
    }

    private function setFeatureTranslations($post, $insert_id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if ($post['edit'] > 0) {
                if (!$this->db->where('abbr', $abbr)->where('for_id', $insert_id)->update('features_translates', array(
                            'title' => $post['title'][$i],
                            'description' => $post['description'][$i]
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                    show_error(lang('database_error'));
                }
            } else {
                if (!$this->db->insert('features_translates', array(
                            'title' => $post['title'][$i],
                            'description' => $post['description'][$i],
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

    public function getFeature($id)
    {
        $array = array();
        $this->db->where('id', $id);
        $result = $this->db->get('features');
        $array = $result->row_array();

        $this->db->where('for_id', $id);
        $result = $this->db->get('features_translates');
        foreach ($result->result_array() as $row) {
            $array['translations'][$row['abbr']] = array(
                'title' => $row['title'],
                'description' => $row['description']
            );
        }
        return $array;
    }

    public function getFeatures($limit, $page)
    {
        $this->db->select('features.id, features.image, features_translates.title, features_translates.description');
        $this->db->where('abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->order_by('features.id', 'desc');
        $this->db->join('features_translates', 'for_id = features.id');
        $query = $this->db->get('features', $limit, $page);
        return $query->result_array();
    }

    public function featuresCount()
    {
        return $this->db->count_all_results('features');
    }

    public function deleteFeature($id)
    {
        if (!$this->db->where('id', $id)->delete('features')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
        if (!$this->db->where('for_id', $id)->delete('features_translates')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

}
