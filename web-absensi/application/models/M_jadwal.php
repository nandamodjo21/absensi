<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{
    public function getJadwal()
    {

        $query = $this->db->query("SELECT p.nira, p.nama, tj.tim, r.nama_ruangan, s.shift,(CASE
        WHEN DATE_FORMAT(k.tanggal,'%W')='Sunday' THEN 'Minggu'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Monday' THEN 'Senin'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Tuesday' THEN 'Selasa'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Wednesday' THEN 'Rabu'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Thursday' THEN 'Kamis'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Friday' THEN 'Jumat'
        WHEN DATE_FORMAT(k.tanggal,'%W')='Saturday' THEN 'Sabtu'
        END) AS hari, k.tanggal, k.kode_konfigurasi,
        CASE
        WHEN k.status = 0 THEN 'belum absen'
        WHEN k.status = 1 THEN 'sudah masuk'
        END AS status
        FROM tb_konfigurasi k 
        LEFT JOIN tb_tim t ON (k.kd_tim= t.kode_tim) 
        LEFT JOIN t_jenis_tim tj ON (t.id_jenis_tim= tj.id_jenis_tim)
        LEFT JOIN rawat_inap r on (k.kode_ruangan= r.kode_ruangan) 
        LEFT JOIN tb_shift s on (k.kode_shift= s.kode_shift)
        JOIN tb_anggota_tim ta ON (k.kd_tim= ta.kd_tim)
        LEFT JOIN pegawai p on (ta.nira= p.nira)  order by k.tanggal, k.kode_shift asc");
        return $query;
    }
    public function lihat_perawat()
    {
        $query = $this->db->query("SELECT * FROM `pegawai` WHERE nira ORDER BY nira asc;");
        return $query;
    }
    public function lihat_tgl($nama)
    {
        $query = $this->db->query("SELECT k.kode_konfigurasi,k.tanggal, k.kode_shift,s.shift FROM tb_konfigurasi k LEFT JOIN tb_tim t ON(k.kd_tim=t.kode_tim) LEFT JOIN tb_anggota_tim ta ON(t.kode_tim=ta.kd_tim) LEFT JOIN pegawai p ON(ta.nira=p.nira) JOIN tb_shift s ON(k.kode_shift=s.kode_shift) WHERE p.nira= '$nama' AND s.shift IN(1,2,3) AND date_add(k.tanggal, interval 1 day) >= date(now()) ORDER BY k.kode_konfigurasi DESC LIMIT 3");
        return $query;
    }

    public function lihat_shift($tgl)
    {

        $query = $this->db->query("SELECT k.kode_konfigurasi, p.nira, p.nama, s.shift FROM tb_konfigurasi k LEFT JOIN tb_tim t ON(k.kd_tim=t.kode_tim) LEFT JOIN tb_anggota_tim ta ON(t.kode_tim=ta.kd_tim) LEFT JOIN pegawai p ON(ta.nira=p.nira) JOIN tb_shift s ON(k.kode_shift=s.kode_shift) WHERE k.tanggal ='$tgl' AND k.kode_shift = '4' ORDER BY k.tanggal ASC");
        return $query;
    }

    public function add_tukar($n1, $n2, $t1, $t2)
    {
        $this->db->query("INSERT INTO t_tukar_shift SELECT k.kode_konfigurasi, '" . $n2 . "' AS nira, k.kode_ruangan, k.kode_shift, k.tanggal, k.status FROM `tb_konfigurasi` k WHERE k.tanggal = '" . $t1 . "' AND k.kd_tim = (SELECT kd_tim FROM tb_anggota_tim WHERE nira='" . $n1 . "')");
        $this->db->query("INSERT INTO t_tukar_shift SELECT k.kode_konfigurasi, '" . $n1 . "' AS nira, k.kode_ruangan, k.kode_shift, k.tanggal, k.status FROM `tb_konfigurasi` k WHERE k.tanggal = '" . $t2 . "' AND k.kd_tim = (SELECT kd_tim FROM tb_anggota_tim WHERE nira='" . $n2 . "')");
    }

    public function list_shift($n, $t)
    {
        $query = $this->db->query("SELECT k.kode_shift FROM `tb_konfigurasi` k WHERE k.tanggal = '" . $t . "' AND k.kd_tim = (SELECT kd_tim FROM tb_anggota_tim WHERE nira='" . $n . "')");
        return $query;
    }

    public function shift_list($t1, $idn1, $idn2)
    {
        $query = $this->db->query("SELECT k.kode_shift FROM `tb_konfigurasi` k WHERE k.tanggal = '" . $t1 . "' AND k.kd_tim = (SELECT kd_tim FROM tb_anggota_tim WHERE nira='" . $idn1 . "')")->result();

        $query = $query[0]->kode_shift;
        return $this->db->query("SELECT k.*,ta.nira,s.shift FROM `tb_konfigurasi` k left join tb_shift s on(k.kode_shift=s.kode_shift),tb_anggota_tim ta LEFT JOIN pegawai p ON(ta.nira=p.nira) WHERE k.kd_tim=ta.kd_tim AND ta.nira ='" . $idn2 . "' AND k.kode_shift='" . $query . "' AND date('" . $t1 . "' + interval 1 day) <= date(k.tanggal)");
        
    }

    public function gettukar()
    {
        return $this->db->query("SELECT t.kode_konfigurasi,p.nira,p.nama,s.shift,t.tanggal FROM t_tukar_shift t LEFT JOIN pegawai p ON( t.nira=p.nira) LEFT JOIN tb_shift s ON(t.kode_shift = s.kode_shift) WHERE t.tanggal >= date(now()) order by t.tanggal asc");
    }
    public function getPerawat()
    {
        return $this->db->query("SELECT * FROM pegawai");
    }

    public function input_perawat($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update_perawat($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data, $where);
    }
    public function hapus_perawat($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getJabatan()
    {
        return $this->db->query("select nira,jabatan from pegawai");
    }
}