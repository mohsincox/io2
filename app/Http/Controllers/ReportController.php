<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function deliveryStatusForm()
    {
        return view('report.delivery_status.form');
    }

    public function deliveryStatusShow(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->start_date;
        $deliveryStatus = $request->delivery_status;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->start_date . ' 23:59:59';

        $adminIdNorth = [15];
        $adminIdSouth = [16];

        // if (in_array(Auth::id(), $adminIdNorth)) {
        if (Auth::user()->zone == 'Dhaka North') {

            $tickets = Ticket::with(['ticketDetails'])->where('delivery_status', $deliveryStatus)->whereIn('sv_assigned_id', $adminIdNorth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        // } else if (in_array(Auth::id(), $adminIdSouth)) {
        } else if (Auth::user()->zone == 'Dhaka South') {

            $tickets = Ticket::with(['ticketDetails'])->where('delivery_status', $deliveryStatus)->whereIn('sv_assigned_id', $adminIdSouth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            $tickets = Ticket::with(['ticketDetails'])->where('delivery_status', $deliveryStatus)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();
        }

        return view('report.delivery_status.show', compact('tickets', 'startDate', 'endDate'));

    }
}
