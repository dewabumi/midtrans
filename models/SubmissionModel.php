<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SubmissionModel extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function insertData($data)
  {
    $this->db->insert('tbl_pendaftar',$data);
  }

  function insertBukti($data2)
  {
    $this->db->insert('tbl_buktitf',$data2);
  }

  function updateBukti($invoice,$data)
  {
    $this->db->where('bukti_pendaftarInvoice', $invoice);
    $this->db->update('tbl_buktitf', $data);
  }

  function readInvoice($invoice)
  {
    $this->db->select('*');
    $this->db->from('tbl_buktitf');
    $this->db->where('bukti_pendaftarInvoice', $invoice);
    $this->db->limit(1);
    $query = $this->db->get();

    if($query->num_rows()==1)
    {
      return $query->result();
    }else{
      return false;
    }
  }

  function listPendaftar()
  {
    $this->db->select('*');
    $this->db->join('tbl_buktitf', 'tbl_buktitf.bukti_pendaftarId = tbl_pendaftar.pendaftarId', 'left');
    $this->db->from('tbl_pendaftar');
    $this->db->where('bukti_status', 1);
    $query = $this->db->get();
    return $query->result();
  }

  function listPendaftarAll()
  {
    $this->db->select('*');
    $this->db->join('tbl_buktitf', 'tbl_buktitf.bukti_pendaftarId = tbl_pendaftar.pendaftarId', 'left');
    $this->db->from('tbl_pendaftar');
    $query = $this->db->get();
    return $query->result();
  }

  function listPendaftarBelum()
  {
    $this->db->select('*');
    $this->db->join('tbl_buktitf', 'tbl_buktitf.bukti_pendaftarId = tbl_pendaftar.pendaftarId', 'left');
    $this->db->from('tbl_pendaftar');
    $this->db->where('bukti_status', 0);
    $query = $this->db->get();
    return $query->result();
  }

  function listPendaftarAlls()
  {
    $this->db->select('*');
    $this->db->from('tbl_pendaftar');
    $query = $this->db->get();
    return $query->result_array();
  }

  function listKoKab()
  {
    $this->db->select('*');
    $this->db->from('tbl_kokab');
    $query = $this->db->get();
    return $query->result();
  }

  function getUser($data)
	{
		$condition = "
	    username=" . "'".$data['username'] . "' and "."
	    password="."'" .$data['password'] . "'";
	    $this->db->select('*');
	    $this->db->from('admin');
	    $this->db->where($condition);
	    $this->db->limit(1);
	    $query = $this->db->get();

	    if($query->num_rows() == 1)
	    {
	       return true;
	    } else {
	       return false;
	    }
	}

	function readUser($username)
    {
      $condition = "username ="."'".$username."'";
      $this->db->select('*');
      $this->db->from('admin');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();

      if($query->num_rows()==1)
      {
        return $query->result();
      }else{
        return false;
      }
    }

    function hapusData($pendaftarId)
    {
      $this->db->trans_start();
      $this->db->where('pendaftarId', $pendaftarId);
      $this->db->delete('tbl_pendaftar');
      $this->db->where('bukti_pendaftarId', $pendaftarId);
      $this->db->delete('tbl_buktitf');
      $this->db->trans_complete();
    }

}
