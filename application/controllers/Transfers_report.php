<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

const TOPUP_SALDO = 1;
const PEMBAYARAN_TRANSFER = 2;

class Transfers_report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transfers_report_model');
        $this->load->model('Transactions_model');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'transfers_report/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transfers_report/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transfers_report/index.html';
            $config['first_url'] = base_url() . 'transfers_report/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transfers_report_model->total_rows($q);
        $transfers_report = $this->Transfers_report_model->get_limit_data($config['per_page'], $start, $q);

        $this->pagination->initialize($config);

        $data = array(
            'view' => 'transfers_report/transfers_report_list',
            'transfers_report_data' => $transfers_report,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
        );

        $this->load->view('main', $data);
    }

    public function read($id)
    {
        $row = $this->Transfers_report_model->get_by_id($id);
        if ($row) {
            $data = array(
                'view' => 'transfers_report/transfers_report_read',
                'transfer_report_id' => $row->transfer_report_id,
                'user_id' => $row->user_id,
                'examiner_id' => $row->examiner_id,
                'type' => $row->type,
                'name' => $row->name,
                'transaction_id' => $row->transaction_id,
                'image' => $row->image,
                'status' => $row->status,
                'created_on' => $row->created_on,
                'processed_on' => $row->processed_on,
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row()
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transfers_report'));
        }
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'user_id' => $this->input->post('user_id', TRUE),
                'examiner_id' => $this->input->post('examiner_id', TRUE),
                'type' => $this->input->post('type', TRUE),
                'name' => $this->input->post('name', TRUE),
                'transaction_id' => $this->input->post('transaction_id', TRUE),
                'image' => $this->input->post('image', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created_on' => $this->input->post('created_on', TRUE),
                'processed_on' => $this->input->post('processed_on', TRUE),
            );

            $this->Transfers_report_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transfers_report'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('user_id', 'user id', 'trim|required');
        $this->form_validation->set_rules('examiner_id', 'examiner id', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('transaction_id', 'transaction id', 'trim|required');
        $this->form_validation->set_rules('image', 'image', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('created_on', 'created on', 'trim|required');
        $this->form_validation->set_rules('processed_on', 'processed on', 'trim|required');

        $this->form_validation->set_rules('transfer_report_id', 'transfer_report_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function create()
    {
        $data = array(
            'view' => 'transfers_report/transfers_report_form',
            'button' => 'Create',
            'action' => site_url('transfers_report/create_action'),
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
            'transfer_report_id' => set_value('transfer_report_id'),
            'user_id' => set_value('user_id'),
            'examiner_id' => set_value('examiner_id'),
            'type' => set_value('type'),
            'name' => set_value('name'),
            'transaction_id' => set_value('transaction_id'),
            'image' => set_value('image'),
            'status' => set_value('status'),
            'created_on' => set_value('created_on'),
            'processed_on' => set_value('processed_on'),
        );
        $this->load->view('main', $data);
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('transfer_report_id', TRUE));
        } else {
            $data = array(
                'user_id' => $this->input->post('user_id', TRUE),
                'examiner_id' => $this->input->post('examiner_id', TRUE),
                'type' => $this->input->post('type', TRUE),
                'name' => $this->input->post('name', TRUE),
                'transaction_id' => $this->input->post('transaction_id', TRUE),
                'image' => $this->input->post('image', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created_on' => $this->input->post('created_on', TRUE),
                'processed_on' => $this->input->post('processed_on', TRUE),
            );

            $this->Transfers_report_model->update($this->input->post('transfer_report_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transfers_report'));
        }
    }

    public function update($id)
    {
        $row = $this->Transfers_report_model->get_by_id($id);

        if ($row) {
            $data = array(
                'view' => 'transfers_report/transfers_report_form',
                'button' => 'Update',
                'action' => site_url('transfers_report/update_action'),
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'transfer_report_id' => set_value('transfer_report_id', $row->transfer_report_id),
                'user_id' => set_value('user_id', $row->user_id),
                'examiner_id' => set_value('examiner_id', $row->examiner_id),
                'type' => set_value('type', $row->type),
                'name' => set_value('name', $row->name),
                'transaction_id' => set_value('transaction_id', $row->transaction_id),
                'image' => set_value('image', $row->image),
                'status' => set_value('status', $row->status),
                'created_on' => set_value('created_on', $row->created_on),
                'processed_on' => set_value('processed_on', $row->processed_on),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transfers_report'));
        }
    }

    public function delete($id)
    {
        $row = $this->Transfers_report_model->get_by_id($id);

        if ($row) {
            $this->Transfers_report_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transfers_report'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transfers_report'));
        }
    }

    public function verifikasi($id)
    {
        if ($id) {
            $buktiTransfer = $this->Transfers_report_model->get_by_id($id);
            $status = ($buktiTransfer->status) ? 0 : 1;

            if ($buktiTransfer->type == PEMBAYARAN_TRANSFER) {
                $transactions = $this->Transactions_model->get_by_id($buktiTransfer->transaction_id);
                $statusPembayaran = ($transactions->status_pembayaran) ? 0 : 1;
                $this->Transactions_model->update($buktiTransfer->transaction_id, ['status_pembayaran' => $statusPembayaran]);
            }

            $buktiTransfer = $this->Transfers_report_model->update($buktiTransfer->transfer_report_id, ['status' => $status]);

            if ($buktiTransfer && $status) {
                switch ($buktiTransfer->type) {
                    case PEMBAYARAN_TRANSFER:
                        redirect(site_url('transactions/read/' . $buktiTransfer->transaction_id));
                        break;
                    case TOPUP_SALDO:
                        redirect(site_url('users/read/' . $buktiTransfer->user_id));
                        break;
                }
            }

            redirect(site_url('transfers_report'));
        }
        show_error('Verifikasi Gagal', 400);
    }

}

/* End of file Transfers_report.php */
/* Location: ./application/controllers/Transfers_report.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-06 12:03:56 */
/* http://harviacode.com */