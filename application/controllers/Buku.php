<?php

require APPPATH . '/libraries/REST_Controller.php';

class Buku extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data buku
    function index_get() {
        $id_buku = $this->get('id_buku');
        if ($id_buku == '') {
            $buku = $this->db->get('buku')->result();
        } else {
            $this->db->where('id_buku', $id_buku);
            $buku = $this->db->get('buku')->result();
        }
        $this->response($buku, 200);
    }

    // insert new data to buku
    function index_post() {
        $data = array(
                    'id_buku'       => $this->post('id_buku'),
                    'judul'         => $this->post('judul'),
                    'pengarang'     => $this->post('pengarang'),
                    'tahun_terbit'  => $this->post('tahun_terbit'));
        $insert = $this->db->insert('buku', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Gagal', 502));
        }
    }

    // update data buku
    function index_put() {
        $id_buku = $this->put('id_buku');
        $data = array(
            'id_buku'           => $this->put('id_buku'),
            'judul'    => $this->put('judul'),
            'pengarang'    => $this->put('pengarang'),
            'tahun_terbit'        => $this->put('tahun_terbit'));
        $this->db->where('id_buku', $id_buku);
        $update = $this->db->update('buku', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'gagal', 502));
        }
    }

    // delete buku
    function index_delete() {
        $id_buku = $this->delete('id_buku');
        $this->db->where('id_buku', $id_buku);
        $delete = $this->db->delete('buku');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'gagal', 502));
        }
    }

}