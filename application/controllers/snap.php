<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
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
        $params = array('server_key' => 'SB-Mid-server-E5lUUNES9N9ZU-aN99o6Fgwg', 'production' => false);
		/*
		Contoh : 
		$params = array('server_key' => 'dhudhsifhduishfidshfuiuhs8ewtYdsbj', 'production' => false); 
		*/
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
		// $this->load->view('checkout_snap');
		$this->load->view('checkout_product');
    }

    public function token()
    {
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$productName = $this->input->post('productName');
		$productPrice = $this->input->post('productPrice');
		$qty = $this->input->post('qty');
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $productPrice*$qty, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => $productPrice,
		  'quantity' => $qty,
		  'name' => $productName
		);

		// // Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 15000,
		//   'quantity' => 1,
		//   'name' => "Squisy"
		// );

		// Optional
		$item_details = array ($item1_details);

		// Optional
		$billing_address = array(
		  'first_name'    => $fname,
		  'last_name'     => $lname,
		  'address'       => $alamat,
		  'city'          => "Default City",
		  'postal_code'   => "40151",
		  'phone'         => $phone,
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Upyourgadget",
		  'last_name'     => "Indonesia",
		  'address'       => $alamat,
		  'city'          => "Bandung",
		  'postal_code'   => "40151",
		  'phone'         => "085320396121",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $fname,
		  'last_name'     => $lname,
		  'email'         => $email,
		  'phone'         => $phone,
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 1440 //24 jam = 60 menit * 24 jam
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
		echo '<bold><a href="https://simulator.sandbox.midtrans.com/bca/va/index">Click di sini untuk pembayaran menggunakan simulasi Midtrans</a></bold>';
		echo '<br/><br/>';
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
		echo '</pre>' ;
		
	}
	
	public function co_product() 
	{
		$this->load->view('checkout_product');
	}
}
