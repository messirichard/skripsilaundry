<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Transactions_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['base_url'] = base_url() . '/users';
        $config['total_rows'] = $this->ion_auth->users(2)->num_rows();
        $config['per_page'] = '10';
        $the_uri_segment = 3;
        $config['uri_segment'] = $the_uri_segment;

        $users = $this->ion_auth->offset($this->uri->segment($the_uri_segment))->limit($config['per_page'])->users(2)->result();
        foreach ($users as $k => $user) {
            $users[$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'view' => 'users/users_list',
            'users_data' => $users,
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
        $row = $this->Users_model->get_by_id($id);
        $transactions = $this->Transactions_model->get_by_id($id);

        if ($row) {
            $data = array(
                'id' => $row->id,
                'username' => $row->username,
                'email' => $row->email,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'phone' => $row->phone,
                'address' => $row->address,
                'balance' => $row->balance,
                'view' => 'users/users_read',
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'transactions_data' => $transactions
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create()
    {
        $data = array(
            'view' => 'users/users_form',
            'button' => 'Create',
            'action' => site_url('users/create_action'),
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
            'id' => set_value('id'),
            'ip_address' => set_value('ip_address'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'salt' => set_value('salt'),
            'email' => set_value('email'),
            'activation_code' => set_value('activation_code'),
            'forgotten_password_code' => set_value('forgotten_password_code'),
            'forgotten_password_time' => set_value('forgotten_password_time'),
            'remember_code' => set_value('remember_code'),
            'created_on' => set_value('created_on'),
            'last_login' => set_value('last_login'),
            'active' => set_value('active'),
            'first_name' => set_value('first_name'),
            'last_name' => set_value('last_name'),
            'company' => set_value('company'),
            'phone' => set_value('phone'),
            'address' => set_value('address'),
            'balance' => set_value('balance'),
        );
        $this->load->view('main', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'ip_address' => $this->input->post('ip_address', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password', TRUE),
                'salt' => $this->input->post('salt', TRUE),
                'email' => $this->input->post('email', TRUE),
                'activation_code' => $this->input->post('activation_code', TRUE),
                'forgotten_password_code' => $this->input->post('forgotten_password_code', TRUE),
                'forgotten_password_time' => $this->input->post('forgotten_password_time', TRUE),
                'remember_code' => $this->input->post('remember_code', TRUE),
                'created_on' => $this->input->post('created_on', TRUE),
                'last_login' => $this->input->post('last_login', TRUE),
                'active' => $this->input->post('active', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'company' => $this->input->post('company', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'address' => $this->input->post('address', TRUE),
                'balance' => $this->input->post('balance', TRUE),
            );

            $this->Users_model->insertMember($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_model->get_by_id($id);
        $user = $this->ion_auth->user($id)->row();
        $user_group = $this->ion_auth->get_users_groups($user->id)->result();

        // print_r($user_group);

        if ($row) {
            $data = array(
                'view' => 'users/users_form',
                'button' => 'Update',
                'action' => site_url('users/update_action'),
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'id' => set_value('id', $row->id),
                'ip_address' => set_value('ip_address', $row->ip_address),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'salt' => set_value('salt', $row->salt),
                'email' => set_value('email', $row->email),
                'activation_code' => set_value('activation_code', $row->activation_code),
                'forgotten_password_code' => set_value('forgotten_password_code', $row->forgotten_password_code),
                'forgotten_password_time' => set_value('forgotten_password_time', $row->forgotten_password_time),
                'remember_code' => set_value('remember_code', $row->remember_code),
                'last_login' => set_value('last_login', $row->last_login),
                'active' => set_value('active', $row->active),
                'first_name' => set_value('first_name', $row->first_name),
                'last_name' => set_value('last_name', $row->last_name),
                'company' => set_value('company', $row->company),
                'phone' => set_value('phone', $row->phone),
                'address' => set_value('address', $row->address),
                'balance' => set_value('balance', $row->balance),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function update_action()
    {
        $this->_update_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password', TRUE),
                'email' => $this->input->post('email', TRUE),
                'active' => $this->input->post('active', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'address' => $this->input->post('address', TRUE),
            );

            $this->Users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
        }
    }



    public function delete($id)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function add_saldo()
    {
        $userId= $this->input->post('user_id');
        $jumlahSaldo = $this->input->post('jumlah_saldo');

        $user = $this->Users_model->get_by_id($userId);

        if ($this->Users_model->update($userId, ['balance' => $user->balance += $jumlahSaldo]))
        {
            $this->session->set_flashdata('message', 'Saldo Berhasil di Tambahkan');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Saldo Gagal di Tambahkan');
            redirect(site_url('users'));
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('balance', 'balance', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _update_rules()
    {

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _employee_rules()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 06:35:49 */
/* http://harviacode.com */