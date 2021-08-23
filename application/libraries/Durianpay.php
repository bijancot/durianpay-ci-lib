<?php

class Durianpay
{
    public $endpoint, $apiKey;

    public function __construct()
    {
        $this->endpoint = "https://api.durianpay.id/v1";
        $this->apikey = base64_encode("dp_live_4SHCqxnY2Yn517EK:");
    }

    private function durianPost($url,$payload){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            "authorization: $this->apikey",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function createOrder($payload){
        $url = $this->endpoint;
        $url = $url.'/orders';
        $result = $this->durianPost($url,$payload);

        return $result;
    }

    public function createEwalletPayment($orderid,$amount,$mobile,$walletType){
        $url = $this->endpoint;
        $url = $url.'/payments/charge';

        $payload = array (
            'type' => 'EWALLET',
            'request' => 
            array (
              'order_id' => 'ord_BqSWnELzJa9507',
              'amount' => 20000,
              'mobile' => '082334059230',
              'wallet_type' => 'DANA',
            ),
        );

        $payload = json_encode($payload);

        $result = $this->durianPost($url,$payload);

        return $result;
    }
}
?>