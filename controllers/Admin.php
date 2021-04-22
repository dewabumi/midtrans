<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata['login'])
		{
			redirect('Auth');
		}
		
	}
  
  public function index()
  {
    $data['listPendaftar']     = $this->SubmissionModel->listPendaftarAll();
    $this->load->view('layout/header');
    $this->load->view('konten/listPendaftar', $data);
    $this->load->view('layout/footer');
  }

  public function Hapus($pendaftarId)
  {
	  $pendaftarId = $this->uri->segment(3);
	  $this->SubmissionModel->hapusData($pendaftarId);
	  redirect($_SERVER['HTTP_REFERER']);
  }

  public function Export()
  {
	  
		$fileName = 'pendaftarAlumni.xlsx';  
	  $pendaftar = $this->SubmissionModel->listPendaftarAlls();
	  $spreadsheet = new Spreadsheet();
	  
	  $sheet = $spreadsheet->getActiveSheet();
	//   set Header
	  $sheet->setCellValue('A1', 'No');
	  $sheet->setCellValue('B1', 'Invoice');
	  $sheet->setCellValue('C1', 'Email');
	  $sheet->setCellValue('D1', 'Nama');
	  $sheet->setCellValue('E1', 'Alamat');
	  $sheet->setCellValue('F1', 'Asal Sekolah');
	  $sheet->setCellValue('G1', 'Telepon');
	  $sheet->setCellValue('H1', 'Tingkat');
	  $sheet->setCellValue('I1', 'Tanggal Daftar');

	//   setRow
	  $kolom = 2;
	  $nomor = 1;
	  foreach($pendaftar as $data)
	  {
		  $sheet->setCellValue('A' . $kolom, $nomor);
		  $sheet->setCellValue('B' . $kolom, $data['pendaftarInvoice']);
		  $sheet->setCellValue('C' . $kolom, $data['pendaftarEmail']);
		  $sheet->setCellValue('D' . $kolom, $data['pendaftarNama']);
		  $sheet->setCellValue('E' . $kolom, $data['pendaftarAlamat']);
		  $sheet->setCellValue('F' . $kolom, $data['pendaftarAsalSekolah']);
		  $sheet->setCellValue('G' . $kolom, $data['pendaftarTelepon']);
		  $sheet->setCellValue('H' . $kolom, $data['pendaftarTingkat']);
		  $sheet->setCellValue('I' . $kolom, date('j F Y', strtotime($data['entry_date'])));
		  $kolom++;
		  $nomor++;
	  }
	  $writer = new Xlsx($spreadsheet);
	  $writer->save("upload/".$fileName);
	  header("Content-Type: application/vnd.ms-excel");
	  redirect(base_url()."/upload/".$fileName);   
  }
}
