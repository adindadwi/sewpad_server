<?php

require APPPATH . '/libraries/REST_Controller.php';

class Tutorial extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data tutorial
    function index_get() {
        $idTutorial = $this->get('idTutorial');
        if ($idTutorial == '') {
            $tutorial = $this->db->get('tutorial')->result();
        } else {
            $this->db->where('idTutorial', $idTutorial);
            $tutorial = $this->db->get('tutorial')->result();
        }
        $this->response($tutorial, 200);
    }

    // insert new data to tutorial
    function index_post() {
        $data = array(
                    'idTutorial'    => $this->post('idTutorial'),
                    'idUser'        => $this->post('idUser'),
                    'tanggal'       => $this->post('tanggal'),
                    'komentar_id'   => $this->post('komentar_id'),
                    'photo_hasil'   => $this->post('photo_hasil'),
                    'nama_tutorial' => $this->post('nama_tutorial'),
                    'kat_id'        => $this->post('kat_id')
                );
        $insert = $this->db->insert('tutorial', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data
    function index_put() {
        $idTutorial = $this->put('idTutorial');
        $data = array(
                    'idTutorial'    => $this->put('idTutorial'),
                    'idUser'        => $this->put('idUser'),
                    'tanggal'       => $this->put('tanggal'),
                    'komentar_id'   => $this->put('komentar_id'),
                    'photo_hasil'   => $this->put('photo_hasil'),
                    'nama_tutorial' => $this->put('nama_tutorial'),
                    'kat_id'        => $this->put('kat_id')
        );
        $this->db->where('idTutorial', $idTutorial);
        $update = $this->db->update('tutorial', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete mahasiswa
    function index_delete() {
        $idTutorial = $this->delete('idTutorial');
        $this->db->where('idTutorial', $idTutorial);
        $delete = $this->db->delete('tutorial');
        if ($delete) {
            $this->response(array('status' => 'Data Berhasil Dihapus'), 201);
        } else {
            $this->response(array('status' => 'Data Gagal dihapus', 502));
        }
    }

}