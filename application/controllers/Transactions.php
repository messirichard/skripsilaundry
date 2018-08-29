<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

const TUNAI = 1;
const SALDO = 2;
const TRANSFER = 3;

const PROSES = 0;
const SELESAI = 1;

const LUNAS = 1;
const BELUM_LUNAS = 0;

class Transactions extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Transactions_model');
        $this->load->model('Laundry_packets_model');
        $this->load->model('Transfers_report_model');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        $this->load->helper('exportexcel_helper');

    }

    public function index() {
        $q = urldecode($this->input->get('q', TRUE));
        $qt = urldecode($this->input->get('qt', TRUE));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url'] = base_url() . 'transactions/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transactions/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transactions/index.html';
            $config['first_url'] = base_url() . 'transactions/index.html';
        }

        $paginationConfig = [
            "base_url" => base_url() . "transactions",
            "per_page" => 10,
            "total_rows" => $this->Transactions_model->total_rows($q),
            "page_query_string" => TRUE,
        ];

        $transactions = $this->Transactions_model->get_limit_data($paginationConfig['per_page'], $start, $q);
        $pagination = $this->pagination->initialize($paginationConfig);

        $laundryPackets = $this->Laundry_packets_model->get_all();

        $data = array(
            'view' => 'transactions/transactions_list',
            'transactions_data' => $transactions,
            'q' => $q,
            'qt' => $qt,
            'laundry_packets' => $laundryPackets,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $this->Transactions_model->total_rows($q),
            'start' => $start,
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
        );

        $this->load->view('main', $data);
    }

    public function read($id) {
        $row = $this->Transactions_model->get_by_id($id);
        if ($row) {
            $data = array(
                'view' => 'transactions/transactions_read',
                'transaction_id' => $row->transaction_id,
                'employee_id' => $row->employee_id,
                'user_id' => $row->user_id,
                'name' => $row->name,
                'laundry_packet_id' => $row->laundry_packet_id,
                'status_pembayaran' => $row->status_pembayaran,
                'weight_total' => $row->weight_total,
                'kuantitas' => $row->laundry_qty,
                'price' => $row->price,
                'retreived_at' => $row->retreived_at,
                'taken_out_at' => $row->taken_out_at,
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transactions'));
        }
    }

    public function create($memberID = 0) {
        $laundryPackets = $this->Laundry_packets_model->get_all();

        $data = array(
            'view' => 'transactions/transactions_form',
            'button' => 'Create',
            'action' => site_url('transactions/create_action'),
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
            'member_id' => $memberID,
            'transaction_id' => set_value('transaction_id'),
            'employee_id' => set_value('employee_id'),
            'user_id' => set_value('user_id'),
            'laundry_packet_id' => set_value('laundry_packet_id'),
            'status_pembayaran' => set_value('status_pembayaran'),
            'weight_total' => set_value('weight_total'),
            'price' => set_value('price'),
            'retreived_at' => set_value('retreived_at'),
            'taken_out_at' => set_value('taken_out_at'),
            'laundry_packets' => $laundryPackets,
        );
        $this->load->view('main', $data);
    }

    public function create_action() {
        if (count($this->input->post('user_id')) == 0) {
            $name = $this->input->post('name');
            $price = $this->input->post('price', TRUE);
            $pembayaran = TUNAI;
            $status_laundry = PROSES;
            $status_pembayaran = LUNAS;
            $user_id = 0;
        } else {
            $user_id = $this->input->post('user_id', TRUE);
            $user = $this->Users_model->get_by_id($user_id);
            $name = $user->first_name . " " . $user->last_name;
            $price = $this->input->post('price', TRUE) * (90 / 100);
            $pembayaran = $this->input->post('pembayaran');

            switch ($pembayaran) {
            case TUNAI:
                $status_laundry = PROSES;
                $status_pembayaran = LUNAS;
                break;
            case SALDO:
                $status_laundry = PROSES;
                $status_pembayaran = LUNAS;
                if ($user->balance > $price) {
                    $this->Users_model->update($user_id, [
                        'balance' => ($user->balance - $price),
                    ]);
                } else {
                    $this->session->set_flashdata('message', 'Saldo tidak mencukupi');
                    redirect(site_url('transactions/create/' . $user_id));
                }
                break;
            default:
                $status_laundry = PROSES;
                $status_pembayaran = BELUM_LUNAS;
                break;
            }
        }

        $data = array(
            'employee_id' => $this->input->post('employee_id', TRUE),
            'user_id' => $user_id,
            'laundry_packet_id' => $this->input->post('laundry_packet_id', TRUE),
            'status_laundry' => $status_laundry,
            'status_pembayaran' => $status_pembayaran,
            'weight_total' => $this->input->post('weight_total', TRUE),
            'laundry_qty' => $this->input->post('laundry_qty', TRUE),
            'price' => $price,
            'name' => $name,
            'payment_type' => $pembayaran,
        );

        $create = $this->Transactions_model->insert($data);

        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('transactions'));
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('transaction_id', TRUE));
        } else {
            $data = array(
                'employee_id' => $this->input->post('employee_id', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
                'laundry_packet_id' => $this->input->post('laundry_packet_id', TRUE),
                'status' => $this->input->post('status', TRUE),
                'weight_total' => $this->input->post('weight_total', TRUE),
                'price' => $this->input->post('price', TRUE),
                'retreived_at' => $this->input->post('retreived_at', TRUE),
                'taken_out_at' => $this->input->post('taken_out_at', TRUE),
            );

            $this->Transactions_model->update($this->input->post('transaction_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transactions'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('employee_id', 'employee id', 'trim|required');
        $this->form_validation->set_rules('user_id', 'user id', 'trim|required');
        $this->form_validation->set_rules('laundry_packet_id', 'laundry packet id', 'trim|required');
        $this->form_validation->set_rules('status_laundry', 'status_laundry', 'trim|required');
        $this->form_validation->set_rules('weight_total', 'weight total', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function update($id) {
        $row = $this->Transactions_model->get_by_id($id);
        $laundryPackets = $this->Laundry_packets_model->get_all();

        if ($row) {
            $data = array(
                'view' => 'transactions/transactions_status_update',
                'button' => 'Update',
                'action' => site_url('transactions/update_action'),
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'transaction_id' => set_value('transaction_id', $row->transaction_id),
                'employee_id' => set_value('employee_id', $row->employee_id),
                'user_id' => set_value('user_id', $row->user_id),
                'laundry_packet_id' => set_value('laundry_packet_id', $row->laundry_packet_id),
                'status_pembayaran' => set_value('status_pembayaran', $row->status_pembayaran),
                'weight_total' => set_value('weight_total', $row->weight_total),
                'price' => set_value('price', $row->price),
                'laundry_packets' => $laundryPackets,
                'retreived_at' => set_value('retreived_at', $row->retreived_at),
                'taken_out_at' => set_value('taken_out_at', $row->taken_out_at),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transactions'));
        }
    }

    public function status_update_action() {
        $data = array(
            'status' => $this->input->post('status', TRUE),
        );
        $this->Transactions_model->update($this->input->post('transaction_id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');

        redirect(site_url('transactions'));
    }

    public function get_price($id) {
        $price = $this->Laundry_packets_model->get_by_id($id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($price));
    }

    public function delete($id) {
        $row = $this->Transactions_model->get_by_id($id);

        if ($row) {
            $this->Transactions_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transactions'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transactions'));
        }
    }

    public function excel() {
        $namaFile = "transactions.xls";
        $judul = "transactions";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;

        xlsBOF();

        xlsWriteLabel(0, 0, $judul);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Employee Id");
        xlsWriteLabel($tablehead, $kolomhead++, "User Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Laundry Packet Id");
     
        xlsWriteLabel($tablehead, $kolomhead++, "Weight Total");
        xlsWriteLabel($tablehead, $kolomhead++, "Laundry Qty");
        xlsWriteLabel($tablehead, $kolomhead++, "Price");
        xlsWriteLabel($tablehead, $kolomhead++, "Retreived At");
  

        foreach ($this->Transactions_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->employee_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteNumber($tablebody, $kolombody++, $data->laundry_packet_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->weight_total);
            xlsWriteNumber($tablebody, $kolombody++, $data->laundry_qty);
            xlsWriteLabel($tablebody, $kolombody++, $data->price);
            xlsWriteLabel($tablebody, $kolombody++, $data->retreived_at);
     

            $tablebody++;
            $nourut++;
        }

        xlsEOF();

        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");
        exit();
    }

    public function transfer_search($qt) {

    }

    public function transfer_list() {

    }

}

/* End of file Transactions.php */
/* Location: ./application/controllers/Transactions.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 19:06:12 */
/* http://harviacode.com */