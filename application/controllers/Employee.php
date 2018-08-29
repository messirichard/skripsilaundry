<?php

class Employee extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['base_url'] = base_url() . '/employee';
        $config['total_rows'] = $this->ion_auth->users(3)->num_rows();
        $config['per_page'] = '10';
        $the_uri_segment = 3;
        $config['uri_segment'] = $the_uri_segment;

        $users = $this->ion_auth->offset($this->uri->segment($the_uri_segment))->limit($config['per_page'])->users(3)->result();
        foreach ($users as $k => $user) {
            $users[$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'view' => 'employees/employees_list',
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

    public function create()
    {
        $data = array(
            'view' => 'employees/employee_form',
            'button' => 'Create',
            'action' => site_url('employee/create_action'),
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
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password', TRUE),
                'email' => $this->input->post('email', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'address' => $this->input->post('address', TRUE),
                'balance' => 0,
            );

            $id = $this->Users_model->insertEmployee($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('employee'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}