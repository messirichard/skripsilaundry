<?php


class Test extends CI_Controller {

    public function index()
    {
        $username = 'admin';
        $password = 'password';
        $email = 'admin@admin.com';
        $additional_data = array(
            'first_name' => 'Jon',
            'last_name' => 'Doe',
        );

        $group = array('1'); // Sets user to member.

        $this->ion_auth->register($username, $password, $email, $additional_data, $group);
    }
    

    public function login()
    {

        $identity = 'admin@admin.com';
		$password = 'password';
		$remember = false; // remember the user
		if ($this->ion_auth->login($identity, $password, $remember)) {
            echo "Logged in";
        }  else {
            echo "Login failed";
        }
    }
}
