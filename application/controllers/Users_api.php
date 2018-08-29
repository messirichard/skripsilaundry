<?php

include_once (APPPATH.'/controllers/api/REST_Controller.php');

class Users_api extends REST_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function profile()
    {
        $this->middleware(['members']);
        return $this->response(200, $this->getUserData());
    }

    public function set_device_token()
    {
        $this->middleware(['members']);
        $user = $this->getUserData();
        $accessToken = $this->input->post('device_token');
        $result = $this->Users_model->updateDeviceToken($user['id'], $accessToken);
        return $this->response(200, $user['id']);
    }


    public function login()
    {
        $identity = $this->input->post('username', TRUE);
        $password = $this->input->post('password');
        $userID = $this->Users_model->get_id_by_username($identity);

        if ($this->ion_auth->hash_password_db($userID, $password) !== TRUE)
        {
            self::show_error('Unauthorized', 401);
        }

        $setToken = $this->Users_model->update($userID, ['access_token' => $this->randomString(16)]);

        if (!$setToken) {
            self::show_error('Unauthorized', 401);
        }

        return $this->response(200, $this->Users_model->get_by_id($userID));
    }

    public function change_password()
    {
        $this->middleware(['members']);
        $oldPassword = $this->input->post('old_password', TRUE);
        $newPassword = $this->input->post('new_password', TRUE);
        $user = $this->getUserData();

        if ($this->ion_auth->hash_password_db($user['id'], $oldPassword) !== TRUE || count($user) == 0 )
        {
            self::show_error('Unauthorized', 401);
        }

        $hashed_new_password  = $this->ion_auth->hash_password($newPassword, "");
        $data = array(
            'password' => $hashed_new_password);

        if ($this->Users_model->update($user['id'], $data)) {
            return $this->response(200, [
                'message' => 'Success',
                'status' => 200
            ]);
        }

        show_error('Failed', 400);
    }

    public function getSaldo()
    {
        $this->middleware(['members']);
        $user = $this->getUserData();

        return $this->response(200, [
            'saldo' => $user['balance'],
        ]);
    }

    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }
}