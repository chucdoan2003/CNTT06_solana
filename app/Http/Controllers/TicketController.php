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
}
