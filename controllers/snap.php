<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-SpgGl4qOXKo5kLDVwnr6y6mc', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }
	
	public function submission()
    {
    	$this->load->view('submissionBox');
    }
	
	
    public function token()
    {
		$nama = $this -> input -> post('nama');
		$telfon = $this -> input -> post('telfon');
		$mail = $this -> input -> post('mail');
		$alamat = $this -> input -> post('alamat');
		$kota = $this -> input -> post('kota');
		$tanggal = $this -> input -> post('tanggal');
		$ortu = $this -> input -> post('ortu');
		$program = $this -> input -> post('program');
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => 100000, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 100000,
		  'quantity' => 1,
		  'name' => "Biaya TO " . $program
		);


		// Optional
		$item_details = array ($item1_details);


		// Optional
		$customer_details = array(
		  'first_name'    => $nama,
		  'email'         => $mail,
		  'phone'         => $telfon,
		  'address'       => $alamat,
		  'program'       => $program,
		  'TTL'           => $tanggal,
		  'nama_ortu'     => $ortu,  
		  'domisili'      => $kota
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 30
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'), true);
		
		$data = [
			'order_id' -> $result['order_id'],
			'gross_amount' -> $result['gross_amount'],
			'nama' -> $result['nama'],
			'telfon' -> $result['telfon'],
			'mail' -> $result['mail'],
			'alamat' -> $result['alamat'],
			'kota' -> $result['kota'],
			'tanggal' -> $result['tanggal'],
			'ortu' -> $result['ortu'],
			'program' -> $result['program'],
			'payment_type' -> $result['payment_type'],
			'transaction_time' -> $result['transaction_time'],
			'bank' -> $result['va_numbers'][0]["bank"],
			'va_numbers' -> $result['va_numbers'][0]["va_number"],
			'pdf_url' -> $result['pdf_url'],
			'status_code' -> $result['status_code']
			
		];
		$simpan =  $this -> db -> insert('tbl_midtrans', $data);
		if ($simpan) {
			echo "Terima Kasih Sudah Mendaftar, Username dan Password akan minGO kirim via WA ya";
		}
		else {
			echo "Gagal";
		}
		

    }
}
