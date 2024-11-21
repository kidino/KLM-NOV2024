<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    protected const PG_NAMESPACE = '\\App\\Libraries\\PaymentGateway\\';

    public function index(Request $request, Plan $plan, $payment_method) {
        if(!in_array($payment_method, Payment::SUPPORTED_GATEWAY)) {
            abort(405, 'Unsupported payment method');
        }

        $payment = $this->record_payment( $plan, $payment_method );

        $pg_classname = self::PG_NAMESPACE . ucfirst( $payment_method );

        // dd($pg_classname);

        $payment_gateway = new $pg_classname();

        $url = $payment_gateway->go( $plan, $payment );

        return redirect( $url );

    }

    public function verify(Request $request, Payment $payment, $payment_method) {

        if(!in_array($payment_method, Payment::SUPPORTED_GATEWAY)) {
            abort(405, 'Unknown payment method');
        }

        $pg_classname = self::PG_NAMESPACE . ucfirst( $payment_method ); 
        $payment_gateway = new $pg_classname();

        $result = $payment_gateway->verify( $request, $payment );

        if($result['success'] && ($payment->payment_status == 'pending')) {
            $this->process_payment($payment);
        }

        echo "<h1>Bayaran Berjaya</h1>";

        // return view('checkout.thankyou');
    }

    private function record_payment(Plan $plan, $payment_method) {

        $user = Auth::user();

        return Payment::create([
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'amount' => $plan->decimal_membership_fee,
            'payment_method' => $payment_method,
            'payment_status' => 'pending',
            'payment_code' => Str::random(30),
            'remarks' => ucfirst( $payment_method ). ' payment for ' . $plan->code
        ]);
    }

    private function process_payment(Payment $payment) {

        $user = User::find( $payment->user_id );
        $plan = Plan::find( $payment->plan_id );

        $duration = 0;
        switch( $plan->term ) {
            case 'monthly' : $duration = '1 month'; break;
            case 'yearly' : $duration = '1 year'; break;
            case 'lifetime' : $duration = '1000 years'; break;
        }

        if( Carbon::parse( $user->expiry_date )->isFuture() ) {
            $user->expiry_date = Carbon::parse( $user->expiry_date )->add( $duration );
        } else {
            $user->expiry_date = Carbon::today()->add( $duration );
        }

        $user->plan_id = $plan->id;

        $user->save();

        $payment->payment_status = 'completed';
        $payment->save();

        return true;

    }
}
