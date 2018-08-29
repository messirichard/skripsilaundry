<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laundry_packets extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laundry_packets_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'laundry_packets/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'laundry_packets/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'laundry_packets/index.html';
            $config['first_url'] = base_url() . 'laundry_packets/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laundry_packets_model->total_rows($q);
        $laundry_packets = $this->Laundry_packets_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'view' => 'laundry_packets/laundry_packets_list',
            'laundry_packets_data' => $laundry_packets,
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
        $row = $this->Laundry_packets_model->get_by_id($id);
        if ($row) {
            $data = array(
                'view' => 'laundry_packets/laundry_packets_read',
                'laundry_packet_id' => $row->laundry_packet_id,
                'name' => $row->name,
                'price' => $row->price,
                'created_at' => $row->created_at,
                'update_at' => $row->update_at,
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('laundry_packets'));
        }
    }

    public function create()
    {
        $data = array(
            'view' => 'laundry_packets/laundry_packets_form',
            'button' => 'Create',
            'action' => site_url('laundry_packets/create_action'),
            'user' => $this->ion_auth->user()->row(),
            'user_group' => $this->ion_auth->get_users_groups()->row(),
            'laundry_packet_id' => set_value('laundry_packet_id'),
            'name' => set_value('name'),
            'price' => set_value('price'),
            'created_at' => set_value('created_at'),
            'update_at' => set_value('update_at'),
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
                'name' => $this->input->post('name', TRUE),
                'price' => $this->input->post('price', TRUE),
                'created_at' => $this->input->post('created_at', TRUE),
                'update_at' => $this->input->post('update_at', TRUE),
            );

            $this->Laundry_packets_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('laundry_packets'));
        }
    }

    public function update($id)
    {
        $row = $this->Laundry_packets_model->get_by_id($id);

        if ($row) {
            $data = array(
                'view' => 'laundry_packets/laundry_packets_form',
                'button' => 'Update',
                'action' => site_url('laundry_packets/update_action'),
                'user' => $this->ion_auth->user()->row(),
                'user_group' => $this->ion_auth->get_users_groups()->row(),
                'laundry_packet_id' => set_value('laundry_packet_id', $row->laundry_packet_id),
                'name' => set_value('name', $row->name),
                'price' => set_value('price', $row->price),
                'created_at' => set_value('created_at', $row->created_at),
                'update_at' => set_value('update_at', $row->update_at),
            );
            $this->load->view('main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('laundry_packets'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('laundry_packet_id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'price' => $this->input->post('price', TRUE),
                'created_at' => $this->input->post('created_at', TRUE),
                'update_at' => $this->input->post('update_at', TRUE),
            );

            $this->Laundry_packets_model->update($this->input->post('laundry_packet_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('laundry_packets'));
        }
    }

    public function delete($id)
    {
        $row = $this->Laundry_packets_model->get_by_id($id);

        if ($row) {
            $this->Laundry_packets_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('laundry_packets'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('laundry_packets'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Laundry_packets.php */
/* Location: ./application/controllers/Laundry_packets.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-31 06:55:55 */
/* http://harviacode.com */