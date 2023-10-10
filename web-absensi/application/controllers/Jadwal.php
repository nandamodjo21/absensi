<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_jadwal');
    }

    public function index()
    {
        $data['title'] = 'JADWAL SHIFT PERAWAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jadwal'] = $this->M_jadwal->getJadwal()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal/index', $data);
        $this->load->view('templates/footer');
    }

    public function tukar()
    {

        // $id = $this->input->post('perawat');
        $data['title'] = 'TUKAR SHIFT PERAWAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['perawat'] = $this->M_jadwal->lihat_perawat()->result();
        $data['tukar'] = $this->M_jadwal->gettukar()->result_array();
        // $data['jadwal'] = $this->M_jadwal->tukarShift()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal/tukar', $data);
        $this->load->view('templates/footer');
    }
    public function cek()
    {
        $nama = $this->input->post('idnama');
        $data = $this->M_jadwal->lihat_tgl($nama)->result();
       
        echo json_encode($data);
        // var_dump($data);
        // die;
    }

    public function shift()
    {
        $tgl = $this->input->post('idtgl');
        
        $data = $this->M_jadwal->lihat_shift($tgl)->result();
       
        echo json_encode($data);
    }

    public function tukar_shift()
    {
        $data['title'] = 'DATA LAPORAN PERAWAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['perawat'] = $this->M_jadwal->lihat_perawat()->result();
        // $data['tukar'] = $this->M_jadwal->gettukar()->result_array();
        // $data['jadwal'] = $this->M_jadwal->tukarShift()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal/laporan', $data);
        $this->load->view('templates/footer');
    }
    public function tampil_shift()
    {
        $n = $this->input->post('idnira');
        $t = $this->input->post('idtgl');
        $data = $this->M_jadwal->list_shift($n)->result();
        echo json_encode($data);
    }

    public function data_shift()
    {
        $t1 = $this->input->post('idtgl');
        $idn1 = $this->input->post('idnira1');
        $idn2 = $this->input->post('idnira2');

        $data = $this->M_jadwal->shift_list($t1, $idn1, $idn2)->result();
        echo json_encode($data);
    }

    public function pertukaran()
    {
        $nira1 = $this->input->post('perawat');
        $tanggal = $this->input->post('tanggal');
        $shift = $this->input->post('shift2');
        $nira2 = $this->input->post('pegawai2');



       $this->M_jadwal->add_tukar($nira1, $nira2, $tanggal, $shift);

      
       $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Perawat Berhasil ditukarkan!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>'
    );
        redirect('jadwal/tukar');
    }
    public function get_pertukaran()

    {
        $data['title'] = 'TUKAR SHIFT PERAWAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal/v_pertukaran', $data);
        $this->load->view('templates/footer');
    }
    public function perawat()
    {
        $data['title'] = ' DATA PERAWAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['perawat'] = $this->M_jadwal->getPerawat()->result_array();
        $data['jabatan'] = $this->M_jadwal->getJabatan()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jadwal/v_perawat', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_perawat()
    {
        $nira = $this->input->post('nira');
        $nama       = $this->input->post('nama');
        $jabatan    = $this->input->post('jabatan');
        $alamat        = $this->input->post('alamat');


        $this->form_validation->set_rules(
            'nira',
            'Nira',
            'required|trim|is_unique[pegawai.nira]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf Anda Gagal Menambahkan Data!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>'
            );
            redirect('jadwal/perawat');
        } else {

            // $conf = array(
            //     'nira'   => $nira,


            // );

            $data = array(
                'nira'   => $nira,
                'nama'         => $nama,
                'jabatan'      => $jabatan,
                'alamat'          => $alamat,
            );
            $this->M_jadwal->input_perawat($data, 'pegawai');
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Oke Data Berhasil Di Tambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'
        );
        redirect('jadwal/perawat');
    }
    public function update_perawat()
    {
        $id = $this->input->post('nira');
        $nira = $this->input->post('idnurs');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');

        $data = array(
            'nira'   => $nira,
            'nama'         => $nama,
            'jabatan'      => $jabatan,
            'alamat'          => $alamat,
        );
        $where = array(
            'nira' => $id

        );
        $this->db->set('nira', $where);
        $this->M_jadwal->update_perawat($where, $data, 'pegawai');
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Oke Data Berhasil Di Ubah!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'
        );
        redirect('jadwal/perawat');
    }
    public function hapus_perawat($id)
    {
        $where = array('nira' => $id);
        $this->M_jadwal->hapus_perawat($where, 'pegawai');
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oke Data Berhasil Di hapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'
        );
        redirect('jadwal/perawat');
    }
}