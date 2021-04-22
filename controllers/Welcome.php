<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
    $this->load->helper(array('email'));
    $this->load->library(array('email'));
		
	}

	public function createSubmission()
	{
    $email = $this->input->post('pendaftarEmail');
    $this->form_validation->set_rules('pendaftarEmail', 'Email', 'required|valid_email|is_unique[tbl_pendaftar.pendaftarEmail]', 
    array(
      'required' => 'Kolom Email harus di isi',
      'is_email' => 'Format Email tidak valid',
      'is_unique'=> $this->input->post('pendaftarEmail') . ' Sudah terdaftar.'
    ));
    $this->form_validation->set_rules('pendaftarNama', 'Nama', 'required');
    $this->form_validation->set_rules('pendaftarTingkat', 'Tingkat', 'required');
    $this->form_validation->set_rules('pendaftarTelepon', 'Telepon', 'required|numeric|is_unique[tbl_pendaftar.pendaftarTelepon]', 
    array('is_unique'=> $this->input->post('pendaftarTelepon') . ' Sudah terdaftar.'));
    $this->form_validation->set_rules('pendaftarAlamat', 'Alamat Lengkap', 'required');
    $this->form_validation->set_rules('pendaftarAsalSekolah', 'Asal Sekolah', 'required');
	$this->form_validation->set_rules('pendaftarTTL', 'Tanggal Lahir', 'required');
	$this->form_validation->set_rules('pendaftaribu', 'Nama Ortu', 'required');


    if($this->form_validation->run() == FALSE)
    {
      $data['email']  = $this->input->post('pendaftarEmail');
      $data['kota']   = $this->SubmissionModel->listKoKab();
      $this->load->view('layout/header');
      $this->load->view('konten/submissionBox',$data);
      $this->load->view('layout/footer');
    }
    else
    {

      $pendTel  = $this->input->post('pendaftarTelepon');
      $email    = $this->input->post('pendaftarEmail');
      $invId    = substr($pendTel, -4);
      $data = array(
        'pendaftarInvoice'      => 'TOGO-'.$invId,
        'pendaftarEmail'        => $this->input->post('pendaftarEmail'),
        'pendaftarNama'         => $this->input->post('pendaftarNama'),
        'pendaftarTelepon'      => $this->input->post('pendaftarTelepon'),
        'pendaftarTingkat'      => $this->input->post('pendaftarTingkat'),
        'pendaftarAlamat'       => $this->input->post('pendaftarAlamat'),
        'pendaftarAsalSekolah'  => $this->input->post('pendaftarAsalSekolah'),
		'pendaftarTTL'          => $this->input->post('pendaftarTTL'),
		'pendaftaribu'  		=> $this->input->post('pendaftaribu'),
      );

      // email handling
      $from           = "officialmarketing.go.pusat@gmail.com";
      $subject        = "Segera Lakukan Pembayaran Try Out Ganesha Operation";
      $message        = "
      <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Sunday Invoice Email</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Header image designed by Freepik.com -->


  <style type='text/css'>
  /* Take care of image borders and formatting */

  img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
  a img { border: none; }
  table { border-collapse: collapse !important; }
  #outlook a { padding:0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass {width:100%;}
  .backgroundTable {margin:0 auto; padding:0; width:100% !important;}
  table td {border-collapse: collapse;}
  .ExternalClass * {line-height: 115%;}


  /* General styling */

  td {
    font-family: Arial, sans-serif;
    color: #6f6f6f;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #6f6f6f;
    font-weight: 400;
    font-size: 18px;
  }


  h1 {
    margin: 10px 0;
  }

  a {
    color: #27aa90;
    text-decoration: none;
  }

  .force-full-width {
    width: 100% !important;
  }

  .force-width-80 {
    width: 80% !important;
  }


  .body-padding {
    padding: 0 75px;
  }

  .mobile-align {
    text-align: right;
  }



  </style>

  <style type='text/css' media='screen'>
      @media screen {
        @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);
        /* Thanks Outlook 2013! */
        * {
          font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
        .w280 {
          width: 280px !important;
        }

      }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='w320'] {
        width: 320px !important;
      }

      td[class*='w320'] {
        width: 280px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
      }

      img[class*='w320'] {
        width: 250px !important;
        height: 67px !important;
      }

      td[class*='mobile-spacing'] {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
      }

      *[class*='mobile-hide'] {
        display: none !important;
      }

      *[class*='mobile-br'] {
        font-size: 12px !important;
      }

      td[class*='mobile-w20'] {
        width: 20px !important;
      }

      img[class*='mobile-w20'] {
        width: 20px !important;
      }

      td[class*='mobile-center'] {
        text-align: center !important;
      }

      table[class*='w100p'] {
        width: 100% !important;
      }

      td[class*='activate-now'] {
        padding-right: 0 !important;
        padding-top: 20px !important;
      }

      td[class*='mobile-block'] {
        display: block !important;
      }

      td[class*='mobile-align'] {
        text-align: left !important;
      }

    }
  </style>
</head>
<body  offset='0' class='body' style='padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none' bgcolor='#eeebeb'>
<table align='center' cellpadding='0' cellspacing='0' width='100%' height='100%'>
  <tr>
    <td align='center' valign='top' style='background-color:#eeebeb' width='100%'>

    <center>

      <table cellspacing='0' cellpadding='0' width='600' class='w320'>
        <tr>
          <td align='center' valign='top'>


          <table style='margin:0 auto; display: inline-block;' cellspacing='0' cellpadding='0' width='100%'>
            <tr>
              <td style='text-align: center; display: inline-block; margin-bottom: 14px; margin-top: 15px;'>
                <a href='#'><img class='w320' src='https://lh3.googleusercontent.com/5cILXNxdRUUwOIIO46nr6X-vMmgGWhqbwuB4tIf0AkPEcsRuzMktVR3OZLKA1_d_oDciEnhUrNuir0Bhv3OmhL_OjAhlvPZSCAklQ4lq0ckCGLEdnwrSWuBpuS7zshp1ej3KhTEc=w2400' alt='company logo' ></a>
                <br>
              </td>
            </tr>
          </table>


          <table cellspacing='0' cellpadding='0' class='force-full-width' style='background-color:#3bcdb0;'>
            <tr>
              <td style='background-color:#3bcdb0;'>

                <table cellspacing='0' cellpadding='0' class='force-full-width'>
                  <tr>
                    <td style='font-size:40px; font-weight: 600; color: #ffffff; text-align:center;' class='mobile-spacing'>
                    <div class='mobile-br'>&nbsp;</div>
                      Segera lakukan peembayaran try out Ganesha Operation
                    <br>
                    </td>
                  </tr>
                </table>

                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td>
                      <img src='https://lh3.googleusercontent.com/9owK2eDepJToIZzspn3v1A1OB6LMxOu-JW6c-WyDNaDoQrJ-w7UuJys7r9sose6peYAL1VYrDCkSSjHbslgRTpROgFreBGl10zYBnEKtKRSwl8OgG8uZYcFor4ZvOA1fs8fKxPhN=w2400' style='max-width:100%; display:block;'>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
          </table>

          <table cellspacing='0' cellpadding='0' class='force-full-width' bgcolor='#ffffff' >
            <tr>
              <td style='background-color:#ffffff; padding-top: 15px;'>

              <center>
                <table style='margin:0 auto;' cellspacing='0' cellpadding='0' class='force-width-80'>
                  <tr>
                    <td style='text-align:left;'>
                    <br>
                      <b>Nama : ".$data['pendaftarNama']."</b> <br>
                      <a>Kota Bimbel : ".$data['pendaftarAsalSekolah']."</a>
                    </td>
                    <td style='text-align:right; vertical-align:top;'>
                    <br>
                    <b>Nomor invoice: ".$data['pendaftarInvoice']."</b> <br>
                    </td>
                  </tr>
                </table>

                <table style='margin:0 auto;' cellspacing='0' cellpadding='0' class='force-width-80'>
                  <tr>
                    <td class='mobile-block' >
                    <br>

                      <table cellspacing='0' cellpadding='0' class='force-full-width'>
                        <tr>
                          <td style='border-bottom:1px solid #e3e3e3; font-weight: bold; text-align: left;'>
                            Deskripsi
                          </td>
                        </tr>
                        <tr>
                          <td style='text-align: left;'>
                            Pendaftaran Try Out Ganesha Operation
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td  class='mobile-block'>
                    <br>

                      <table cellspacing='0' cellpadding='0' class='force-full-width'>
                        <tr>
                          <td style='border-bottom:1px solid #e3e3e3; font-weight: bold;'>
                          </td>
                        </tr>
                        <tr>
                          <td >
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='mobile-block'>
                    <br>

                      <table cellspacing='0' cellpadding='0' class='force-full-width'>
                        <tr>
                          <td style='border-bottom:1px solid #e3e3e3; font-weight: bold;' class='mobile-align'>
                           Program
                          </td>
                        </tr>
                        <tr>
                          <td class='mobile-align'>
                            ".$data['pendaftarTingkat']."
                            <br>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>


                <table style='margin: 0 auto;' cellspacing='0' cellpadding='0' class='force-width-80'>
                  <tr>
                    <td style='text-align: left;'>
                    <br>
                      Terima kasih sudah melakukan pendaftaran try out Ganesha Operation
                    </td>
                  </tr>
                </table>

                <table style='margin: 0 auto;' cellspacing='0' cellpadding='0' class='force-width-80'>
                  <tr>
                    <td style='text-align: left;'>
                    <br>
                      Jika ada pertanyaan, silahkan hubungi <a style='color: #f5774e; text-decoration: none;'href='https://api.whatsapp.com/send?phone=6285722153093&text=&source=&data='>admin kami</a><br><br>
                      Terima Kasih, <br>
                      Admin Ganesha Operation
                    </td>
                  </tr>
                </table>
              
                </center>

              </td>
            </tr>
          </table>







          </td>
        </tr>
      </table>

    </center>




    </td>
  </tr>
</table>
</body>
</html>
      ";

      $config         = array(
        'protocol'		=> 'smtp',
				'smtp_host'		=> 'ssl://smtp.gmail.com',
				'smtp_port'		=> '465',
				'smtp_user'		=> 'officialmarketing.go.pusat@gmail.com',
				'smtp_pass'		=> 'atleast8char!', 
				'newline'   	=> "\r\n",
		    'crlf'      	=> "\r\n",
		    'mailtype'    => "html",
		    'charset'   	=> "utf-8",
		    'wordwrap'    => TRUE
      );
      $this->load->library('email', $config);
      $this->email->initialize($config);
      $this->email->from($from, 'Ganesha Operation Mailer');
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()) 
      {
        $this->SubmissionModel->insertData($data);
        $ids = $this->db->insert_id();
        $data2 = array(
          'bukti_pendaftarId'       => $ids,
          'bukti_pendaftarInvoice'  => 'TOGO-'.$invId
        );
        $this->SubmissionModel->insertBukti($data2);
  
        $this->load->view('layout/header');
        $this->load->view('konten/submissionBox',$data);
        $this->load->view('layout/footer');
      } else {
        show_error($this->email->print_debugger());
      }
    }
  }
  
  public function uploadBukti()
  {
    $invoice = $this->input->post('bukti_pendaftarInvoice');
    $this->form_validation->set_rules('bukti_namaPemilikRek', 'Nama Pemilik Rekening', 'required');
    $this->form_validation->set_rules('invoice', 'Nomor Invoice', 'required');
    if($this->form_validation->run() == FALSE)
    {
      $this->load->view('layout/header');
      $this->load->view('konten/uploadBukti');
      $this->load->view('layout/footer');
    }
    else 
    {
      $invoice      = $this->input->post('invoice');
      $result       = $this->SubmissionModel->readInvoice($invoice);
      if($result != TRUE) {
        $data['tidak']        = "nomor invoice tidak terdaftar, harap melakukan pendaftaran terlebih dahulu";
        $this->load->view('layout/header');
        $this->load->view('konten/uploadBukti',$data);
        $this->load->view('layout/footer');
      } else {
        $path        = $_FILES['bukti_transfer']['name'];
        $ext         = pathinfo($path, PATHINFO_EXTENSION);

        $nama                   = $invoice.'.'.$ext;
        $config['upload_path']  = "./assets/images/bukti_transfer/";
        $config['allowed_types']= "gif|jpg|jpeg|png";
        $config['max_size']     = "2048000";
        $config['max_width']    = '5000';
        $config['max_height']   = '5000';
        $config['overwrite']    = TRUE;
        $config['file_name']    = $nama;
        
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('bukti_transfer'))
        {
          $error = array('error' => $this->upload->display_errors());
          $this->load->view('layout/header');
          $this->load->view('konten/uploadBukti', $error);
          $this->load->view('layout/footer');
        }
        else
        {

          $data = array(
            'bukti_namaPemilikRek'    => $this->input->post('bukti_namaPemilikRek'),
            'bukti_image'             => $nama,
            'bukti_status'            => 1
          );
          $this->SubmissionModel->updateBukti($invoice, $data);
          redirect('Welcome/thankYouPage');
        }
      }
      
    }
  }

  public function thankYouPage()
  {
    $this->load->view('layout/header');
    $this->load->view('konten/thankYouPage');
    $this->load->view('layout/footer');    
  }

  public function testPage()
  {
    $this->load->view('konten/testPage');
  }

}
