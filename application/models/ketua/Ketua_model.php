<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ketua_model extends CI_Model
{
    public function getProfile($id = 0)
    {

        if ($id < 1) {
            $id = $this->session->userdata('userid');
        }

        return $this->db->get_where('ketua', ["kode_ketua" => $id])->row_array();
    }

    public function update()
    {

        $post = $this->input->post();


        $this->kode_ketua = $post["kode_ketua"];

        $this->nama = $post["nama"];

        $this->nip = $post["nip"];

        $this->jeniskel = $post["jeniskel"];

        $this->telp = $post["telp"];

        $this->email = $post["email"];

        $this->password = $post['password'];

        if (!empty($_FILES["foto"]["name"])) {

            $this->foto = $this->_uploadImage();
        } else {

            $this->foto = $post["gambar_lama"];
        }

        return $this->db->update('ketua', $this, array('kode_ketua' => $post['kode_ketua']));
    }

    private function _uploadImage()
    {
        $date = substr(date('Ymd'), 2, 8);

        $post = $this->input->post();

        $config['upload_path']          = './assets/data/ketua/pas_foto/';

        $config['allowed_types']        = 'gif|jpg|png';

        $config['file_name']            = $date . '-' . $_FILES['foto']['name'];

        $config['overwrite']            = true;

        $config['max_size']             = 5000; // 1MB

        // $config['max_width']            = 1024;

        // $config['max_height']           = 768;



        $this->load->library('upload', $config);



        if ($this->upload->do_upload('foto')) {

            return $this->upload->data("file_name");
        }

        return base_url('assets/data/ketua/pas_foto/') . $post["gambar_lama"];
    }
}
