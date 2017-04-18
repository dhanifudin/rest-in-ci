<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_Model extends CI_Model
{
    public function all($id)
    {
        return $this->db
            ->get_where('todo', ['user_id' => $id])
            ->result();
    }

    public function get($id) {
        return $this->db
            ->get_where('todo', ['id' => $id])
            ->row();
    }

    public function create(array $post, $token)
    {
        $data = [
            'user_id' => $token->id,
            'todo' => $post['todo'],
            'done' => $post['done'],
        ];
        $this->db->insert('todo', $data);
        return $this->db->insert_id();
    }

}
