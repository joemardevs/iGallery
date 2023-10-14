<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function pay($id, Request $request)
    {
        $artwork = Artwork::find($id);
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

            if ($is_paid) {
                $artwork->is_sold = 1;
                $artwork->save();
            } else {
                $artwork->is_sold = 0;
                $artwork->save();
            }

            $request->session()->forget('payment_sessionId');

            return view('livewire.pages.payment.success', [
                'title' => $title
            ]);
        }
        abort(403, 'You must buy a artwork to igallery.');
    }
}
