<?php

require APPPATH . 'libraries/REST_Controller.php';

class Buku extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('BukuM');

    $this->methods['index_get']['limit'] = 100;
    $this->methods['add_post']['limit'] = 100;
    $this->methods['update_put']['limit'] = 100;
    $this->methods['delete_delete']['limit'] = 100;

  }


  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
    $id_buku = $this->get('id_buku');
    if ($id_buku == null) {
      $buku = $this->BukuM->all_detailbuku();
    } else {
      $buku = $this->BukuM->all_detailbuku($id_buku);
    }

    if ($buku) {
      $this->response([
        'status' => true,
        'data' => $buku
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => true,
        'message' => 'id buku tidak ada'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  // untuk menambah person menaggunakan method post
  public function add_post(){
    $buku = $this->BukuM->add_detailbuku(
      $this->post('judul_buku'),
      $this->post('penulis'),
      $this->post('penerbit'),
      $this->post('tahun_terbit')
    );
    $this->response($buku);
  }

  // update data person menggunakan method put
  public function update_put(){
    $buku = $this->BukuM->update_detailbuku(
      $this->put('id_buku'),
      $this->put('judul_buku'),
      $this->put('penulis'),
      $this->put('penerbit'),
      $this->put('tahun_terbit')

    );
    $this->response($buku);
  }

  // hapus data person menggunakan method delete
  public function delete_delete(){
    $buku = $this->BukuM->delete_detailbuku(
      $this->delete('id_buku')
    );
    $this->response($buku);
  }

}

?>
