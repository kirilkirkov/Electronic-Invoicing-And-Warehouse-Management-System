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
            $this->db->where('id', $post['edit']);
            $this->db->update('features', array(
                'image' => $post['image']
            ));
            $insert_id = $post['edit'];
        } else {
            $this->db->insert('features', array(
                'image' => $post['image']
            ));
            $insert_id = $this->db->insert_id();
        }
        $this->setFeatureTranslations($post, $insert_id);
    }

    private function setFeatureTranslations($post, $insert_id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            if ($post['edit'] > 0) {
                $this->db->where('for_id', $insert_id);
                $this->db->where('abbr', $abbr);
                $this->db->update('features_translates', array(
                    'title' => $post['title'][$i],
                    'description' => $post['description'][$i]
                ));
            } else {
                $this->db->insert('features_translates', array(
                    'title' => $post['title'][$i],
                    'description' => $post['description'][$i],
                    'abbr' => $abbr,
                    'for_id' => $insert_id
                ));
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
        $this->db->where('id', $id);
        $this->db->delete('features');
        $this->db->where('for_id', $id);
        $this->db->delete('features_translates');
    }

}
