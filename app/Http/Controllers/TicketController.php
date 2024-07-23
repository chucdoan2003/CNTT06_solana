<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

use function Psy\debug;

class TicketController extends Controller
{
    public function addTicket(TicketRequest $request)
    {
        $data = $request->all();

        $ticket = Ticket::create($data);

        return response()->json(['message' => 'Thêm mới thành công !', 'data' => $ticket]);
    }

    public function listTicket()
    {
        $items = Ticket::all(); // Lấy tất cả các mục từ cơ sở dữ liệu
        return response()->json($items); // Trả về dữ liệu dưới dạng JSON
    }
    public function getTicketsByCategoryId($cateID)
    {
        $tickets = Ticket::where('cateID', $cateID)->get();
        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'Tickets không tồn tại trong Category'], 404);
        }

        return response()->json(['tickets' => $tickets], 200);
    }
}
