<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

use function Psy\debug;

class WalletController extends Controller
{
    public function postWallet(Request $request)
    {
       

        $wallet = $request->all();
        debug($wallet);

        return response()->json(['message' => 'Wallet data stored successfully!', 'wallet' => $wallet]);
    }
}
