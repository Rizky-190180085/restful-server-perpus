<?php

// extends class Model
class BukuM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $buku['status']='error';
    $buku['message']='Field tidak boleh kosong';
    return $buku;
  }



  // mengambil semua data person
  public function all_detailbuku($id_buku = null){

    if ($id_buku === null) {
      return $this->db->get('tb_buku')->result_array();
    }

    else{
      return  $this->db->get_where('tb_buku', ['id_buku' => $id_buku])->result_array();
    }


  }


  // function untuk insert data ke tabel tb_mahasiswa
  public function add_detailbuku($judul_buku,$penulis,$penerbit,$tahun_terbit){

    if(empty($judul_buku) || empty($penulis) || empty($penerbit) || empty($tahun_terbit)){
      return $this->empty_response();
    }else{
      $data = array(
        "judul_buku"=>$judul_buku,
        "penulis"=>$penulis,
        "penerbit"=>$penerbit,
        "tahun_terbit"=>$tahun_terbit
      );

      $insert = $this->db->insert("tb_buku", $data);

      if($insert){
        $buku['status']='Berhasil';
        $buku['message']='Data Detail Buku Telah Ditambahkan.';
        return $buku;
      }else{
        $buku['status']='error';
        $buku['message']='Data Detail Buku Gagal Ditambahkan.';
        return $buku;
      }
    }

  }



  // hapus data person
  public function delete_detailbuku($id_buku){

    if($id_buku == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id_buku"=>$id_buku
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_buku");
      if($delete){
        $buku['status']=200;
        $buku['error']=false;
        $buku['message']='Data Detail Buku Telah Dihapus.';
        return $buku;

      }
      else{
        $buku['status']=502;
        $buku['error']=true;
        $buku['message']='Data Detail Buku Gagal Dihapus.';
        return $buku;
      }
    }

  }





  // update person
  public function update_detailbuku($id_buku,$judul_buku,$penulis,$penerbit, $tahun_terbit){

    if($id_buku == '' || empty($judul_buku) || empty($penulis) || empty($penerbit) || empty($tahun_terbit)){
      return $this->empty_response();
    }else{
      $where = array(
        "id_buku"=>$id_buku
      );

      $set = array(
        "id_buku"=>$id_buku,
        "judul_buku"=>$judul_buku,
        "penulis"=>$penulis,
        "penerbit"=>$penerbit,
        "tahun_terbit"=>$tahun_terbit

      );

      $this->db->where($where);
      $update = $this->db->update("tb_buku",$set);
      if($update){
        $buku['status']=200;
        $buku['error']=false;
        $buku['message']='Data Buku Berhasil Diubah.';
        return $buku;
      }else{
        $buku['status']=502;
        $buku['error']=true;
        $buku['message']='Data Buku Gagal Diubah.';
        return $buku;
      }
    }

  }





}

?>
