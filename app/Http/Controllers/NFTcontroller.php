<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NFTcontroller extends Controller
{
    public function createForm()
    {
        return view('create');
    }

    public function createNFT(Request $request)
    {
        $myHeaders = [
            'x-api-key' => 'JwjL_ALgf3syYbXi',
        ];

        $rawBody = [
            'network' => 'devnet',
            'metadata_uri' => 'https://brown-loyal-stoat-734.mypinata.cloud/ipfs/QmR5Tyx3MvpiCKtjTVC4wVzRigpujCv9bnvQKU4ZMQzN5N',
            'max_supply' => 0,
            'collection_address' => '3F3G122hfRQ6E7aRQLhdXvabxtfhGHF89UVLvHR4pmn9',
            'receiver' => '5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js',
            'fee_payer' => '5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js',
            'service_charge' => [
                'receiver' => '5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js',
                'amount' => 0.01,
            ],
            'priority_fee' => 100,
        ];

        try {
            $response = Http::withHeaders($myHeaders)
                ->post('https://api.shyft.to/sol/v1/nft/create_from_metadata', $rawBody);

            $result = $response->json();
            // In giá trị ra để kiểm tra
            Log::info('Shyft API response:', $result);

            if ($response->successful() && isset($result['result']['encoded_transaction'])) {
                return response()->json([
                    'message' => 'NFT Created Successfully!',
                    'data' => [
                        'encoded_transaction' => $result['result']['encoded_transaction'],
                    ],
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed to create NFT',
                    'error' => $result,
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create NFT',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
