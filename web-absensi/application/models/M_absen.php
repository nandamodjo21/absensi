<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_absen extends CI_Model
{
    public function getAbsen()
    {

        $query = $this->db->query("SELECT a.kd_absen, a.nira,p.nama,j.jenis_absen,tj.tim,a.waktu FROM `t_absen` a LEFT JOIN pegawai p on(a.nira=p.nira) LEFT JOIN t_jenis_absen j ON(a.kd_jenis_absen=j.kd_jenis_absen) LEFT JOIN tb_konfigurasi k ON(a.kode_konfigurasi = k.kode_konfigurasi) LEFT JOIN tb_tim t ON(k.kd_tim=t.kode_tim) LEFT JOIN t_jenis_tim tj ON(t.id_jenis_tim=tj.id_jenis_tim)
    ORDER BY a.waktu ASC");
        return $query;
    }

    public function rekapan_data()
    {
        return $this->db->query("SELECT ra.nira,ra.nama, GROUP_CONCAT(IF(isnull(a1.nira),IF(ra.kode_shift IN (1,2,3),'A',ra.shift),concat('m:',time(a1.waktu),' / p:',time(a2.waktu))) SEPARATOR ',') AS shift FROM v_rekap_all ra LEFT JOIN t_absen a1 ON(a1.nira = ra.nira AND ra.tanggal = date(a1.waktu) AND a1.kd_jenis_absen = 1) LEFT JOIN t_absen a2 ON(a2.nira = ra.nira AND ra.tanggal = date(a2.waktu) AND a2.kd_jenis_absen = 2) GROUP BY ra.nira ORDER BY ra.nira ASC ");
    }
    public function getTim()
    {
        return $this->db->query("SELECT t.kode_tim,tj.* FROM tb_tim t LEFT JOIN t_jenis_tim tj ON(t.id_jenis_tim=tj.id_jenis_tim)");
    }
    public function getShift()
    {
        return $this->db->query("SELECT kode_shift,shift FROM tb_shift");
    }
    public function getRuangan()
    {
        return $this->db->query("SELECT * FROM rawat_inap");
    }

    public function add_jadwal($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function getjdwal()
    {
        return $this->db->query("SELECT c.kd_jadwal,tj.tim, ta.nira,p.nama,s.shift,r.nama_ruangan,c.waktu from t_coba c left join tb_tim t on(c.kd_tim=t.kode_tim) left join t_jenis_tim tj on(t.id_jenis_tim=tj.id_jenis_tim) left join tb_anggota_tim ta on(t.kode_tim = ta.kd_tim) left join pegawai p on(ta.nira = p.nira) left join tb_shift s on(c.kode_shift= s.kode_shift) left join rawat_inap r on(c.kode_ruangan = r.kode_ruangan) order by t.kode_tim asc");
    }
    
}