<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\User;
use App\Models\DeliveryStatus;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.index'); 
    }

    public function ticketId(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        if (isset($ticket)) {
        	if (Auth::user()->role == 'app_user') {
	            // $dsList  = DeliveryStatus::where('id', '<>', 1)->pluck('name', 'name');
                if ($ticket->delivery_status == 'Order confirmed') {
                $dsList = ['Order collected from depot' => 'Order collected from depot'];
            } else if ($ticket->delivery_status == 'Order collected from depot') {
                $dsList = ['On the way for order deliver' => 'On the way for order deliver'];
            } else if ( ( $ticket->delivery_status == 'Order delivered (cash payment)' ) || ( $ticket->delivery_status == 'Order delivered (card payment)' ) || ( $ticket->delivery_status == 'Order cancelled' ) || ( $ticket->delivery_status == null ) ) {
                $dsList = [];
            } else {
                $dsList = ['Order delivered (cash payment)' => 'Order delivered (cash payment)', 'Order delivered (card payment)' => 'Order delivered (card payment)'];
            }
            
	            return view('home.user_ticket_edit', compact('ticket', 'dsList'));
	        } else if (Auth::user()->role == 'app_admin') {
	            $appUserList  = User::where('role', 'app_user')->pluck('name', 'id');
	            return view('home.admin_ticket_edit', compact('ticket', 'appUserList'));
	        }
        } else {
	        flash()->error($request->ticket_id . ' Order ID does not exist.');
        	return redirect()->back();
    	}
    }

    public function dateWise(Request $request)
    {
    	$createdDate = $request->created_date;
        $startDateTime = $request->created_date . ' 00:00:00';
        $endDateTime = $request->created_date . ' 23:59:59';


    	$tickets = Ticket::whereBetween('created_at', [$startDateTime, $endDateTime])
    		->orderBy('id', 'desc')
    		->get();

    	return view('search.date_wise_ticket', compact('tickets', 'createdDate'));
    }

    public function phoneNumberWise(Request $request)
    {
    	$phoneNumber = $request->phone_number;

    	$tickets = Ticket::where('phone_number', $phoneNumber)
    		->orderBy('id', 'desc')
    		->get();

    	return view('search.phone_wise_ticket', compact('tickets', 'phoneNumber'));
    }
}
