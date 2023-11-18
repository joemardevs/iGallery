<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    //
    public function pay($id, Request $request)
    {
        $artwork = Artwork::find($id);
        $buyer = auth()->user();
        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency'      => 'PHP',
                            'amount'        => $artwork->price * 100,
                            'description'   => 'text',
                            'name'          => $artwork->title,
                            'quantity'      => 1,
                        ]
                    ],
                    "payments" => [
                        "attributes" => [
                            "billing" => [
                                "email" => $buyer->email,
                                "name" => $buyer->name,
                            ]
                        ],
                    ],
                    'payment_method_types' => [
                        'gcash',
                        // 'paymaya',
                    ],
                    'success_url' => env('APP_URL') . '/artwork/payment/success',
                    'cancel_url' => env('APP_URL') . '/artwork/' . $artwork->id,
                    'description' => $artwork->title
                ],
            ]
        ];

        // Send the POST request
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => 'Basic c2tfdGVzdF9BSm44cDR6WDlWNzVQMThrWGt1TTVGSnA6',
        ])
            ->withBody(json_encode($data))
            ->post('https://api.paymongo.com/v1/checkout_sessions');

        $request->session()->put('payment_sessionId', $response['data']['id']);

        return redirect()->to($response['data']['attributes']['checkout_url']);
    }
    public function success(Request $request)
    {
        $title = 'Payment Success';
        $payment_session = $request->session()->get('payment_sessionId');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Basic c2tfdGVzdF9BSm44cDR6WDlWNzVQMThrWGt1TTVGSnA6',
        ])
            ->get('https://api.paymongo.com/v1/checkout_sessions/' . $payment_session);

        if ($request->session()->has('payment_sessionId')) {

            $is_paid = $response['data']['attributes']['payments'][0]['attributes']['status'] === "paid";
            $artwork = Artwork::where('title', $response['data']['attributes']['line_items'][0]['name'])->first();
            $buyer = User::where('email', $response['data']['attributes']['payments'][0]['attributes']['billing']['email'])->first();

            //Validating transaction
            $validatedForm = $request->validate([
                'artwork_id' => ['nullable', Rule::exists('artworks', 'id')],
                'user_id' => ['nullable', Rule::exists('users', 'id')],
                'checkout_id' => ['nullable'],
                'paid_at' => ['nullable'],
            ]);
            
            if($buyer === null){
                abort(403, 'You must buy a artwork with your email and name logged in.');
            }

            if ($is_paid) {

                $artwork->is_sold = 1;
                //Creating transaction on database
                $validatedForm['artwork_id'] = $artwork->id;
                $validatedForm['user_id'] = $buyer->id;
                $validatedForm['checkout_id'] = $response['data']['id'];
                $validatedForm['paid_at'] = now();

                Transaction::create($validatedForm);
                //save the artwork to is_sold is true
                $artwork->save();
            } else {
                $artwork->is_sold = 0;
                $artwork->save();
            }

            $request->session()->forget('payment_sessionId');

            return view('livewire.pages.payment.success', [
                'title' => $title,
<<<<<<< HEAD
                'artwork_name' => $artwork->title,
=======
                'artwork' => $artwork->title,
>>>>>>> 1b29ad7d7ea490807450ac6558fbebe79959c8ec
                'buyer_name' => $buyer->name,
                'reference_number' => $response['data']['id'],
                'payment_time' => now(),
                'payment_method' => $response['data']['attributes']['payment_method_types'][0],
<<<<<<< HEAD
                'amount' => $response['data']['attributes']['line_items'][0]['amount'] / 100
            ]);
        }

=======
                'amount' => $response['data']['attributes']['line_items'][0]['amount']
            ]);
        }
        // return view('livewire.pages.payment.success', [
        //     'title' => $title,
        //     'artwork_name' => $artwork->title,
        //     'buyer_name' => $buyer->name,
        //     'reference_number' => $response['data']['id'],
        //     'payment_time' => now(),
        //     'payment_method' => $response['data']['attributes']['payment_method_types'][0],
        //     'amount' => $response['data']['attributes']['line_items'][0]['amount']
        // ]);
>>>>>>> 1b29ad7d7ea490807450ac6558fbebe79959c8ec
        abort(403, 'You must buy a artwork to igallery.');
    }
}
