<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Support\Facades\Http;
use Curl;

class PaymentController extends Controller
{
    //
    public function pay($id)
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
                    'success_url' => 'http://igallery.test/',
                    'cancel_url' => 'http://igallery.test/artwork/' . $artwork->id,
                    'description' => 'iGallery'
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

        // dd($response->json('data.attributes.checkout_url'));
        return redirect()->to($response['data']['attributes']['checkout_url']);
    }
}
