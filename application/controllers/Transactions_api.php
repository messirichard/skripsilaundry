<?php

include_once APPPATH . '/controllers/api/REST_Controller.php';

class Transactions_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transactions_model');
    }

    public function set_laundry_status() {
        $transactionID = $this->input->post('transaction_id');
        $transaction = $this->Transactions_model->get_by_id($transactionID);
        $laundryStatus = !$transaction->status_laundry;

        if ($laundryStatus) {
            $this->send_notification($this->Users_model->get_by_id($transaction->user_id)->device_token, $transactionID);
        }

        $this->Transactions_model->update($transactionID, ['status_laundry' => $laundryStatus]);

        $this->response(200, $transactionID);
    }

    public function set_laundry_taken_status() {
        $transactionID = $this->input->post('transaction_id');
        $transaction = $this->Transactions_model->get_by_id($transactionID);
        $laundryStatus = !$transaction->status_pengambilan;

        $this->Transactions_model->update($transactionID, [
            'status_pengambilan' => $laundryStatus,
            'taken_out_at' => date("Y-m-d H:i:s"),
        ]);

        $this->response(200, $transactionID);
    }

    public function send_notification($to, $body) {
        $data = array('body' => 'Laundry No. ' . $body . ' Selesai', 'title' => 'Laundryanku');
        $to = $to;

        $this->sendMessage($data, $to);
    }

    public function sendMessage($data, $target) {
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAV03VaqM:APA91bHCGFyZVjzYB5T6KBP-Rs9gAYhME11IV8h9ITQeB_6Pq9jdj2hkpm--Pkxo0-FxOcDNACrdnQG436UWMYMqBXipREQyWtnvDsjnCdDb-DwTkto8p7DXZa7MJcDaZlgRD9CuRSF7';

        $fields = array();
        $fields['notification'] = $data;
        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public function user_transactions() {
        $this->middleware(["members"]);
        $userid = $this->getUserData()['id'];
        $transactions = $this->Transactions_model->get_user_transactions($userid);

        $this->response(200, $transactions);
    }
}