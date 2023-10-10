<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_absen');
    }

    public function index()
    {
        $data['title'] = 'DATA ABSEN';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['absen'] = $this->M_absen->getAbsen()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absen/index', $data);
        $this->load->view('templates/footer');
    }

    public function rekapan()
    {
        $data['title'] = 'REKAPAN KEHADIRAN';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rekapan'] = $this->M_absen->rekapan_data()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absen/rekapan', $data);
        $this->load->view('templates/footer');
    }

    public function input_jadwal()
    {
        $data['title'] = 'COBA';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jadwal'] = $this->M_absen->getjdwal()->result_array();
        $data['tim'] = $this->M_absen->getTim()->result();
        $data['shift'] = $this->M_absen->getShift()->result();
        $data['ruangan'] = $this->M_absen->getRuangan()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absen/coba', $data);
        $this->load->view('templates/footer');
    }
    public function tambah_jadwal()
    {
        $tim = $this->input->post('tim');
        $shift = $this->input->post('sip');
        $ruangan = $this->input->post('ruangan');
        $waktu = $this->input->post('tanggal');

        $data = [
            'kd_tim' => $tim,
            'kode_shift' => $shift,
            'kode_ruangan' => $ruangan,
            'waktu' => $waktu
        ];

        $this->db->set('kd_jadwal', 'UUID()', false);
        $this->M_absen->add_jadwal($data, 't_coba');
        redirect('absen/input_jadwal');
    }
}
