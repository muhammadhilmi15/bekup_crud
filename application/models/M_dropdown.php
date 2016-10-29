<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dropdown extends CI_Model
{

    function dd_kelamin()
    {
        $query = "SELECT * FROM kelamin";
        $kelamin = $this->db->query($query);
        if ($kelamin->num_rows() > 0) {
            return $kelamin->result();
        } else {
            return array();
        }
    }

    function dd_kota()
    {
        $query = "SELECT * FROM kota";
        $kota = $this->db->query($query);
        if ($kota->num_rows() > 0) {
            return $kota->result();
        } else {
            return array();
        }
    }

    function dd_posisi()
    {
        $query = "SELECT * FROM posisi";
        $posisi = $this->db->query($query);
        if ($posisi->num_rows() > 0) {
            return $posisi->result();
        } else {
            return array();
        }
    }

}
