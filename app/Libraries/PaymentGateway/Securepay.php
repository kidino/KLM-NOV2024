<?php 

namespace App\Libraries\PaymentGateway; 

use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Securepay {

    private $uid;

    private $auth_token;

    private $checksum_token;

    private $api_url = '';

    function __construct() {
        $this->api_url = 'https://' 
            . ((env('APP_ENV') == 'local') ? 'sandbox.' : '')
            . 'securepay.my/api/v1/payments';

        $this->uid = env('SECUREPAY_UID');
        $this->auth_token = env('SECUREPAY_AUTH_TOKEN');
        $this->checksum_token = env('SECUREPAY_CHECKSUM_TOKEN');
    }

    public function go(Plan $plan, Payment $payment) {

        $user = User::find( $payment->user_id );

        $buyer_phone = null;

        $verify_url = route('checkout.verify', [
            'payment' => $payment->payment_code,
            'payment_method' => 'securepay'
        ]);

        $string = $user->email .'|'. 
            $user->name .'|'.
            $buyer_phone .'|'.
            $verify_url .'|'.
            $payment->payment_code .'|'. 
            $payment->remarks .'|'. 
            $verify_url .'|'.
            $payment->amount .'|'. 
            $this->uid;

        $sign = hash_hmac( 'sha256', $string, $this->checksum_token);

        $post_data = 'buyer_name=' . urlencode( $user->name ) . 
        '&token=' . urlencode( $this->auth_token ) . 
        '&callback_url=' . urlencode( $verify_url ) . 
        '&redirect_url=' . urlencode( $verify_url ) . 
        '&order_number=' . urlencode( $payment->payment_code ) . 
        '&buyer_email=' . urlencode( $user->email ) . 
        '&buyer_phone=' . urlencode( $buyer_phone ) . 
        '&transaction_amount=' . urlencode( $payment->amount ) . 
        '&product_description=' . urlencode( $payment->remarks ) . 
        '&redirect_post=' . urlencode( 'true' ) . 
        '&checksum=' . urlencode( $sign );

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $this->api_url); 
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); 

        if( env('APP_ENV') == 'local') {
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        }

        $output = curl_exec( $ch );
        
        if (curl_errno($ch)) {
            $error_msg = curl_errno($ch).' - '.curl_error($ch);
            echo $error_msg;
        } else {
            echo $output;
        }
    }

    public function verify(Request $request, Payment $payment) {

        // dd($request);

        $data = $request->all();
        $user = User::find($payment->user_id);

        if(
            ($data['transaction_amount_received'] == $payment->amount)
            && ($data['payment_status'] == 'true')
            && ($data['currency'] == 'MYR')
        ) {

            Auth::login($user);

            return [
                'success' => true
            ];
        }

        return  [
            'success' => false,
            'errors' => []
        ];
    }    

}