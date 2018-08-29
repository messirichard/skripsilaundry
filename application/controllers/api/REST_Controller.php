<?php

class REST_Controller extends CI_Controller
{
    private $bearerToken;
    private $middleware;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Groups_model');
        $this->load->model('Users_model');
        $this->load->model('Transfers_report_model');
    }

    public function getUserData()
    {
        if ($this->checkUserToken()) {
            $user = $this->Users_model->get_by_access_token($this->getAccessToken());
            $data = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'balance' => $user->balance,
                'access_token' => $user->access_token
            ];

            return $data;

        } else {
            $this->response(401, 'Unauthorized');
        }
    }

    public function checkUserToken()
    {
        return (count($this->Users_model->get_by_access_token($this->getAccessToken()))) ? true : false;
    }

    public function getAccessToken()
    {
        $bearer = explode(" ", trim($this->input->get_request_header('Authorization', TRUE)));
        return ($bearer[0] == "Bearer") ? $bearer[1] : false;
    }

    public function response($code, $data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($code)
            ->set_output(json_encode(array(
                'data' => $data,
                'status' => $code
            )));
    }

    public function middleware($roles)
    {
        $user = $this->getUserData();

        if (!$this->ion_auth->in_group($roles, $user['id']) || count($user) == 0) {
            self::show_error('Unauthorized', 401);
        }
    }

    public static function show_error($message, $code)
    {
        exit(json_encode([
            'message' => $message,
            'status' => $code
        ]));
    }

    public function randomString($length)
    {
        $string = bin2hex(openssl_random_pseudo_bytes($length)); // 20 chars
        return $string;
    }
}