<?php

include_once(APPPATH . '/controllers/api/REST_Controller.php');

class Transfer_Report_api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    public function do_upload()
    {
        $this->middleware(['members']);

        $type = $this->input->post('type');
        $transactionID = $this->input->post('transaction_id');
        $user = $this->getUserData();

        $config['upload_path'] = UPLOADS;
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $new_name = time() . '-' . $user['username'] . '-' . $transactionID;
        $config['file_name'] = $new_name;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            self::show_error($error, 400);
        } else {
            $uploadData = $this->upload->data();

            $data = [
                'name' => $user['first_name'] . " " . $user['last_name'],
                'user_id' => $user['id'],
                'image' => UPLOADS."/".$new_name.$uploadData['file_ext'],
                'status' => 0,
                'type' => $type,
                'transaction_id' => $transactionID
            ];

            $data = $this->Transfers_report_model->insert($data);

            $this->response(200, $data);
        }
    }
}
