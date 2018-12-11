<?php

require APPPATH . '/libraries/REST_Controller.php';

class Peminjam extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data peminjam
    function index_get() {
        $id_peminjam = $this->get('id_peminjam');
        if ($id_peminjam == '') {
            $peminjam = $this->db->get('peminjam')->result();
        } else {
            $this->db->where('id_peminjam', $id_peminjam);
            $peminjam = $this->db->get('peminjam')->result();
        }
        $this->response($peminjam, 200);
    }

    // insert new data to peminjam
    function index_post() {
        $data = array(
                    'id_peminjam'           => $this->post('id_peminjam'),
                    'nama'    => $this->post('nama'),
                    'alamat'    => $this->post('alamat'),
                    'telpn'        => $this->post('telpn'));
        $insert = $this->db->insert('peminjam', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Gagal', 502));
        }
    }

    // update data peminjam
    function index_put() {
        $id_peminjam = $this->put('id_peminjam');
        $data = array(
            'id_peminjam'           => $this->put('id_peminjam'),
            'nama'    => $this->put('nama'),
            'alamat'    => $this->put('alamat'),
            'telpn'        => $this->put('telpn'));
        $this->db->where('id_peminjam', $id_peminjam);
        $update = $this->db->update('peminjam', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'gagal', 502));
        }
    }

    // delete peminjam
    function index_delete() {
        $id_peminjam = $this->delete('id_peminjam');
        $this->db->where('id_peminjam', $id_peminjam);
        $delete = $this->db->delete('peminjam');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'gagal', 502));
        }
    }

}