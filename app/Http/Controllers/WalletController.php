<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Dotenv\Exception\ValidationException;

class WalletController extends Controller
{
    public function postWallet(WalletRequest $request)
    {

        $wallet = $request['wallet'];
        $gmail = $request['gmail'] ?? null;

        $existingWallet = Wallet::where('wallet', $wallet)
            // ->where('gmail', $gmail)
            ->first();

        if ($existingWallet) {
            return response()->json(['message' => 'Wallet xác thực thành công', 'wallet' => $existingWallet], 200);
        }

        // orm
        $newWallet = Wallet::create([
            'wallet' => $wallet,
            'gmail' => $gmail,

        ]);


        return response()->json(['message' => 'Wallet data stored successfully!', 'wallet' => $wallet]);
    }
}
