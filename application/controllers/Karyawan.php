<?php 
    defined('BASEPATH') OR die('No direct script allowed!');

    class Karyawan extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct ();
            is_login();
            redirect_if_level_not('Manager');
            $this->load->model('Karyawan_model', 'karyawan');
        }

        public function index()
        {
            $data['karyawan'] = $this->karyawan->get_all();
            return $this->template->load('template', 'karyawan/index', $data);
        }

        public function create()
        {
            $this->load->model('Divisi_model', 'divisi');
            $data['divisi'] = $this->divisi->get_all();
            return $this->template->load('template', 'karyawan/create', $data);
        }

        public function store()
        {
            $post = $this->input->post();
            $data = [
                'nik' => $post['nik'],
                'nama' => $post['nama'],
                'telp' => $post['telp'],
                'divisi' => $post['divisi'],
                'email' => $post['email'],
                'username' => $post['username'],
                'password' => $post['password']
            ];

            $result = $this->karyawan->insert_data($data);
            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Karyawan berhasil ditambahkan!'
                ];
                redirect('Karyawan');
            }
        }
    }
?> 