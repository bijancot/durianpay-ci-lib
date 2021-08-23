<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
		//loading ongkir-library
		parent::__construct();
		$this->load->library("durianpay");
    }

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
	public function index()
	{
		$payload = array (
			'amount' => '20000',
			'payment_option' => 'full_payment',
			'currency' => 'IDR',
			'order_ref_id' => 'order_ref_001',
			'customer' => 
			array (
			  'customer_ref_id' => 'cust_001',
			  'given_name' => 'Jane Doe',
			  'email' => 'jane_doe@nomail.com',
			  'mobile' => '85722173217',
			  'address' => 
			  array (
				'receiver_name' => 'Jude Casper',
				'receiver_phone' => '8987654321',
				'label' => 'Jude\'s Address',
				'address_line_1' => 'Jl. HR. Rasuna Said',
				'address_line_2' => 'Apartment #786',
				'city' => 'Jakarta Selatan',
				'region' => 'Jakarta',
				'country' => 'Indonesia',
				'postal_code' => '560008',
				'landmark' => 'Kota Jakarta Selatan',
			  ),
			),
			'items' => 
			array (
			  0 => 
			  array (
				'name' => 'LED Television',
				'qty' => 1,
				'price' => '20000',
				'logo' => 'https://merchant.com/product_001/tv_image.jpg',
			  ),
			),
			'metadata' => 
			array (
			  'my-meta-key' => 'my-meta-value',
			  'SettlementGroup' => 'BranchName',
			),
		);

		$payload = json_encode($payload);
		$orderid = $this->durianpay->createOrder($payload)['id'];

		//type available : VA/EWALLET
		$mobile="0895326927698";
		$paynow = $this->durianpay->createEwalletPayment($orderid,20000,$mobile,"LINKAJA");

		var_dump($paynow);
	}
}
