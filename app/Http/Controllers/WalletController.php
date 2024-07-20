<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function postWallet(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'address' => 'required|string|unique:wallets',
            'balance' => 'required|numeric',
            'gmail' => 'required|string|email',
        ]);

        // Lấy dữ liệu từ request
        $walletData = $request->all();
        $gmail = $walletData['gmail'];
        $address = $walletData['address']; // Đổi tên biến cho phù hợp với tên cột trong cơ sở dữ liệu


        // Kiểm tra xem gmail và địa chỉ ví đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingWallet = Wallet::where('gmail', $gmail)
            ->where('address', $address)
            ->first();

        if ($existingWallet) {
            return response()->json(['message' => 'Wallet xác thực thành công', 'wallet' => $existingWallet], 200);
        }


        // Lưu trữ dữ liệu ví mới vào cơ sở dữ liệu
        $wallet = Wallet::create([
            'address' => $validatedData['address'],
            'gmail' => $validatedData['gmail'],
        ]);

        
        return response()->json(['message' => 'Wallet data stored successfully!', 'wallet' => $wallet]);
    }
}
