<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\User;
use App\Models\DeliveryStatus;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'app_user') {
            $userTickets = Ticket::where('db_assigned_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
            return view('home.user_ticket', compact('userTickets'));
        } else if (Auth::user()->role == 'app_admin') {

            $adminIdAllZone = [13, 14, 35, 36, 49];
            $adminIdNorth = [15];
            $adminIdSouth = [16];

            if (in_array(Auth::id(), $adminIdAllZone)) {

                $adminTickets = Ticket::orderBy('id', 'desc')->paginate(10);

            } else if (in_array(Auth::id(), $adminIdNorth)) {

                $adminTickets = Ticket::whereIn('sv_assigned_id', $adminIdNorth)->orderBy('id', 'desc')->paginate(10);

            } else if (in_array(Auth::id(), $adminIdSouth)) {

                $adminTickets = Ticket::whereIn('sv_assigned_id', $adminIdSouth)->orderBy('id', 'desc')->paginate(10);

            } else {
                
                 return redirect('/logout');
            }

            return view('home.admin_ticket', compact('adminTickets'));
        }  else {
            return redirect('/logout');
        } 
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
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

            $adminIdAllZone = [13, 14, 35, 36, 49];
            $adminIdNorth = [15];
            $adminIdSouth = [16];

            if (in_array(Auth::id(), $adminIdAllZone)) {

                $appUserList  = User::where('role', 'app_user')->orderBy('depot_app_user', 'asc')->pluck('depot_app_user', 'id');

            } else if (in_array(Auth::id(), $adminIdNorth)) {

                $appUserList  = User::where('role', 'app_user')->where('zone', 'Dhaka North')->orderBy('depot_app_user', 'asc')->pluck('depot_app_user', 'id');

            } else if (in_array(Auth::id(), $adminIdSouth)) {

                $appUserList  = User::where('role', 'app_user')->where('zone', 'Dhaka South')->orderBy('depot_app_user', 'asc')->pluck('depot_app_user', 'id');

            } else {
                
                 return redirect('/');
            }
            
            return view('home.admin_ticket_edit', compact('ticket', 'appUserList'));
        }
    }

    public function updateUser(Request $request, $id)
    {
        $input = Input::all();
        $rules = [
            'delivery_status_blank' => 'required',
        ];
        $messages = [
            'delivery_status_blank.required' => 'The Delivery Status field is required.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $ticket = Ticket::find($id);
        $ticket->delivery_status = $request->delivery_status_blank;
        $ticket->ticket_status_id = 2;
        $ticket->updated_by = Auth::id();
        $ticket->save();

        $ticketDetail = new TicketDetail;
        $ticketDetail->ticket_id = $ticket->id;
        $ticketDetail->ticket_status_id = 2;
        $ticketDetail->remarks = $ticket->delivery_status;
        $ticketDetail->created_by = Auth::id();
        $ticketDetail->save();

        if ( ($ticket->delivery_status == 'Order delivered (cash payment)') || ($ticket->delivery_status == 'Order delivered (card payment)') ) {
            $smsPhoneNumber = $ticket->phone_number;
            $smsBody = "Your order has been delivered. Order ID is ".$ticket->id.". Enjoy Igloo Ice Cream. To know about recent promotional offers, please call 16556. Thank you.";

            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=3768cecd-b47d-4358tkn-9e64-395288340fa9&sid=IGLOO&sms=".$smsBody."&msisdn=".$smsPhoneNumber."&csms_id=123456789");

            $a = $res->getBody();
        }

        flash()->success('Successfully Updated');
        return redirect()->back();
    }

    public function updateAdmin(Request $request, $id)
    {
        $input = Input::all();
        $rules = [
            'app_user_id' => 'required',
        ];
        $messages = [
            'app_user_id.required' => 'The Delivery Boy field is required.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $ticket = Ticket::find($id);
        $ticket->db_assigned_id = $request->app_user_id;
        $ticket->ticket_status_id = 2;
        $ticket->updated_by = Auth::id();
        $ticket->save();

        $dbUser = User::find($request->app_user_id);

        $ticketDetail = new TicketDetail;
        $ticketDetail->ticket_id = $ticket->id;
        $ticketDetail->ticket_status_id = 2;
        $ticketDetail->remarks = 'Assign to: '.$dbUser->depot_app_user;
        $ticketDetail->app_user = $request->app_user_id;
        $ticketDetail->created_by = Auth::id();
        $ticketDetail->save();


        $smsPhoneNumber = $dbUser->phone_number;
        $smsBody = "You have received a new order. ID: " . $ticket->id . ", Name: " . $ticket->customer_name . ", Mob: " . $ticket->phone_number . ", Add:" . $ticket->customer_address . ". Please open App";

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=3768cecd-b47d-4358tkn-9e64-395288340fa9&sid=IGLOO&sms=".$smsBody."&msisdn=".$smsPhoneNumber."&csms_id=123456789");

        $a = $res->getBody();
        
        flash()->success('Successfully Updated');
        return redirect()->back();
    }
}
