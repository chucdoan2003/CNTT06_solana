<?php

namespace App\Http\Controllers;

use App\Http\Requests\NFTRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\Active;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NFTcontroller extends Controller
{
    public function newTicket(Request $request)
    {
        $dataID = $request->id;
        $dataWallet = $request->wallet;
        $soluong = $request->soluong;

        $ticket = Ticket::where('id', $dataID)->first();
        $mota = $ticket->mota;
        $image = $ticket->urlimage;
        $name = $ticket->name;



        $user = Wallet::where('wallet', $dataWallet)->first();
        $walletUser = $user->wallet;

        // Kiểm tra nếu không tìm thấy ticket hoặc user
        if (!$ticket || !$user) {
            return response()->json(['error' => 'Ticket hoặc User không tồn tại'], 404);
        }



        $client = new \GuzzleHttp\Client();

        //api tạo nft
        $response = $client->request('POST', 'https://api.gameshift.dev/nx/unique-assets', [
            'body' => json_encode([
                'details' => [
                    'collectionId' => 'ff6402d5-754d-4849-aa9d-039ce8579fab',
                    'description' => $mota,
                    'imageUrl' => $image,
                    'name' => $name
                ],
                'destinationUserReferenceId' => '2'
            ]),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'x-api-key' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiI5NzEyODFhMC0yNTU1LTQ4MzQtOWFkYS02MDFiZTM0NjRmMWUiLCJzdWIiOiI2OTc3NjAzNS01OWQ0LTRhOTctOTM5MC03NDY3OWI3M2JiNTYiLCJpYXQiOjE3MjEzMTIyNjR9.4ggWNZZ47uJN4ntux_Tm87kf3XXQaWaRo3DA2qp6De0',
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        $assetId = $responseData['id'];

        sleep(50);
        // tranfer nft
        $transferResponse = $client->request('POST', "https://api.gameshift.dev/nx/users/2/items/$assetId/transfer", [
            'body' => json_encode([ 
                'destinationWallet' => $walletUser,
                'quantity' => $soluong
            ]),
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'x-api-key' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiI5NzEyODFhMC0yNTU1LTQ4MzQtOWFkYS02MDFiZTM0NjRmMWUiLCJzdWIiOiI2OTc3NjAzNS01OWQ0LTRhOTctOTM5MC03NDY3OWI3M2JiNTYiLCJpYXQiOjE3MjEzMTIyNjR9.4ggWNZZ47uJN4ntux_Tm87kf3XXQaWaRo3DA2qp6De0',
            ],
        ]);


        $transferResponseData = json_decode($transferResponse->getBody(), true);
        $Link = $transferResponseData['consentUrl'];
        if (!empty($Link)) {
            $dataconsentUrl = Active::create([
                'link' => $transferResponseData['consentUrl'],
                'status' => 1
            ]);
        } else {

            throw new Exception('Link is empty or invalid');
        }

        return response()->json($transferResponseData);
    }
}
