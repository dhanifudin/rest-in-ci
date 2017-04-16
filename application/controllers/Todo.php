<?php

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Todo extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('todo_model');
    }

    public function index_get($id = null)
    {
        $headers = $this->input->request_headers();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
                $todo = ($id != null)
                    ? $this->todo_model->get($id)
                    : $this->todo_model->all($token->id);
                $this->set_response($todo, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response('Forbidden', REST_Controller::HTTP_FORBIDDEN);
    }

    public function index_post()
    {
        $headers = $this->input->request_headers();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
                $dataPost = $this->input->post();
                $id = $this->todo_model->create($dataPost, $token);
                if ($id != false) {
                    $todo = $this->todo_model->get($id);
                    $this->set_response($todo, REST_Controller::HTTP_OK);
                    return;
                }
            }
            $this->set_response('Unauthorized', REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
        $this->set_response('Forbidden', REST_Controller::HTTP_FORBIDDEN);
    }
}
