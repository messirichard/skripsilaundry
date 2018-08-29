<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction_out extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_out_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'transaction_out/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transaction_out/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transaction_out/index.html';
            $config['first_url'] = base_url() . 'transaction_out/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaction_out_model->total_rows($q);
        $transaction_out = $this->Transaction_out_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);



        $data = array(
            'view' => 'transaction_out/transaction_out_list',
            'transaction_out_data' => $transaction_out,
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
        $row = $this->Transaction_out_model->get_by_id($id);
        if ($row) {
            $data = array(
                'transaction_out_id' => $row->transaction_out_id,
                'nama_barang' => $row->nama_barang,
                'tanggal' => $row->tanggal,
                'harga' => $row->harga,
                'quantity' => $row->quantity,
                'harga_total' => $row->harga_total,
            );
            $this->load->view('transaction_out/transaction_out_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaction_out'));
        }
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
                'harga_total' => $this->input->post('harga', TRUE) * $this->input->post('quantity', TRUE),
            );

            $this->Transaction_out_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaction_out'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function create()
    {
        $data = array(
            'view' => 'transaction_out/transaction_out_form',
            'button' => 'Create',
            'action' => site_url('transaction_out/create_action'),
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
            'nama_barang' => set_value('nama_barang'),
            'tanggal' => set_value('tanggal'),
            'harga' => set_value('harga'),
            'quantity' => set_value('quantity'),
            'harga_total' => set_value('harga_total'),
        );
        $this->load->view('main', $data);
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('transaction_out_id', TRUE));
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
                'harga_total' => $this->input->post('harga_total', TRUE),
            );

            $this->Transaction_out_model->update($this->input->post('transaction_out_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaction_out'));
        }
    }

    public function update($id)
    {
        $row = $this->Transaction_out_model->get_by_id($id);

        if ($row) {
            $data = array(
                'view' => 'transaction_out/transaction_out_form',
                'button' => 'Update',
                'action' => site_url('transaction_out/update_action'),
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'transaction_out_id' => set_value('transaction_out_id', $row->transaction_out_id),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'harga' => set_value('harga', $row->harga),
                'quantity' => set_value('quantity', $row->quantity),
                'harga_total' => set_value('harga_total', $row->harga_total),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaction_out'));
        }
    }

    public function delete($id)
    {
        $row = $this->Transaction_out_model->get_by_id($id);

        if ($row) {
            $this->Transaction_out_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaction_out'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaction_out'));
        }
    }

    public function akumulasi()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $start_date = DateTime::createFromFormat('Y-m-d', $start_date)->format('Y-m-d 00:00:00');
        $end_date = DateTime::createFromFormat('Y-m-d', $end_date)->format('Y-m-d 00:00:00');


        $transaksi = $this->Transaction_out_model->dateBetween($start_date, $end_date);
        $akumulasi = 0;

        foreach ($transaksi as $t) {
            $akumulasi += $t->harga_total;
        }

        echo json_encode(array("akumulasi" => $akumulasi));
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaction_out.xls";
        $judul = "transaction_out";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga");
        xlsWriteLabel($tablehead, $kolomhead++, "Quantity");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Total");

        foreach ($this->Transaction_out_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->harga);
            xlsWriteNumber($tablebody, $kolombody++, $data->quantity);
            xlsWriteLabel($tablebody, $kolombody++, $data->harga_total);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Transaction_out.php */
/* Location: ./application/controllers/Transaction_out.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 19:10:20 */
/* http://harviacode.com */