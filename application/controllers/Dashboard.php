<?php

class Dashboard extends CI_Controller {
    public function index($page = 'dashboard')
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->in_group(['admin', 'Karyawan'])) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

        $data = [
            'view' => 'dashboard/dashboard',
            'page' => 'Dashboard',
            'action' => 'index',
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row()
        ];
        
        $this->load->view('main', $data);
    }
    
    public function login()
    {
        $this->load->view('login');
    }
}