<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $first_name = 'first_name';
    public $last_name = 'last_name';
    public $order = 'DESC';
    private $access_token = 'access_token';
    private $device_token = 'device_token';
    private $email = 'email';
    private $username = 'username';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by name
    function get_by_name($name)
    {
        $name = explode(" ", $name);
        $this->db->where($this->first_name, $name[0]);
        if (isset($name[1])) {
            $this->db->where($this->first_name, $name[1]);
        }
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('salt', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('address', $q);
        $this->db->or_like('balance', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('salt', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('address', $q);
        $this->db->or_like('balance', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insertEmployee($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $additional_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'balance' => $data['balance'],
        );

        $group = array('3'); // Sets user to employee.

        $this->ion_auth->register($username, $password, $email, $additional_data, $group);
    }

    function insertMember($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $additional_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'balance' => $data['balance'],
        );

        $group = array('2'); // Sets user to member.

        $this->ion_auth->register($username, $password, $email, $additional_data, $group);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return ($this->db->affected_rows() > 0);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // get user id by username
    function get_id_by_username($username)
    {
        if ($username == null || $username == "") {
            return false;
        }
        $this->db->where($this->username, $username);
        return $this->db->get($this->table)->row()->id;
    }

    // get user data by access_token
    function get_by_access_token($token)
    {
        $this->db->where($this->access_token, $token);
        return $this->db->get($this->table)->row();
    }

    // set user device token
    public function updateDeviceToken($id, $deviceToken)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, ['device_token' => $deviceToken]);
        return ($this->db->affected_rows() > 0);
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 06:35:49 */
/* http://harviacode.com */