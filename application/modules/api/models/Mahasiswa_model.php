<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function read($id = NULL)
    {
        if($id == NULL)
        {
            return $this->db->get('mahasiswa');
        }
        else
        {
            $this->db->where('id', $id);
            return $this->db->get('mahasiswa');
        }
    }

    public function create()
    {
        $data   = [
            'nim'           => $this->input->post('nim'),
            'nama'          => $this->input->post('nama'),
            'tahun_masuk'   => $this->input->post('tahun_masuk'),
        ];
        return $this->db->insert('mahasiswa', $data);
    }

    public function update($id)
    {
        $data   = [
            'nim'           => $this->input->post('nim'),
            'nama'          => $this->input->post('nama'),
            'tahun_masuk'   => $this->input->post('tahun_masuk'),
        ];
        $this->db->where('id', $id);
        return $this->db->update('mahasiswa', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('mahasiswa');
    }
}
