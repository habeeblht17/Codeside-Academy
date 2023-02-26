<?php

namespace App\Http\Controllers\Instructor;

use App\Traits\General;
use App\Models\User_card;
use App\Models\User_paypal;
use App\Models\User_account;
use Illuminate\Http\Request;
use App\Traits\ImageSaveTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Instructor\CardRequest;
use App\Http\Requests\Instructor\MyAccountRequest;

class AccountController extends Controller
{
    use  ImageSaveTrait, General;

    public function myCard()
    {
        $data['title'] = 'My Card';
        $data['navPaymentActiveClass'] = 'active';
        $data['instructorAccounts'] = User_account::where('user_id', Auth::id())->get();
        return view('instructor.account.my-card', $data);
    }

    public function saveMyAccount(MyAccountRequest $request)
    {
        $data = [
            'account_number' => $request->account_number,
            'bank_code' => $request->bank_code,
        ];

        $resolve_account_fn = $this->resolve_account_number($data);

        // echo $resolve_account_fn; exit();

        $decode_resolve_account_fn = json_decode($resolve_account_fn);

        //Check for connection
        if($decode_resolve_account_fn){
            //Check for status
            if($decode_resolve_account_fn->status === true){

                User_account::where('user_id', Auth::id())->updateOrCreate([
                    'user_id' => Auth::id(),
                    'account_number' => $decode_resolve_account_fn->data->account_number,
                    'account_name' => $decode_resolve_account_fn->data->account_name,
                    'bank_code' => $request->bank_code,
                ]);

                $this->showToastrMessage('success', 'Update Successfully');
                return redirect()->back();

            }
            else {
                toastrMessage('error', $decode_resolve_account_fn->message);
                return redirect()->back();
            }
        }
        else {
            toastrMessage('error', 'Something is wrong. Try after few minutes!');
            return redirect()->back();
        }

    }


    public function resolve_account_number($data)
    {
        $curl = curl_init();

        $account_number = $data['account_number'];
        $bank_code = $data['bank_code'];

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . $account_number ."&bank_code=" . $bank_code,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }


    // public function getAllBanks()
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.paystack.co/bank?currency=NGN",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: Bearer ". env('PAYSTACK_SECRET_KEY'),
    //             "Cache-Control: no-cache",
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     return $response;

    // }

    // public function saveMyCard(CardRequest $request)
    // {
    //     User_card::where('user_id', Auth::id())->updateOrCreate([
    //         'user_id' => Auth::id(),
    //         'card_number' => $request->card_number,
    //         'card_holder_name' => $request->card_holder_name,
    //         'month' => $request->month,
    //         'year' => $request->year,
    //     ]);

    //     $this->showToastrMessage('success', 'Update Successfully');
    //     return redirect()->back();
    // }

    // public function savePaypal(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required'
    //     ]);

    //     User_paypal::where('user_id', Auth::id())->updateOrCreate([
    //         'user_id' => Auth::id(),
    //         'email' => $request->email
    //     ]);

    //     $this->showToastrMessage('success', 'Update Successfully ');
    //     return redirect()->back();
    // }
}
