<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function warrantyDetailForm()
    {
        return view('report.warranty_detail.form');
    }

    public function warrantyDetailShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';


        $warrantyDetails = WarrantyDetail::with(['ticket', 'ticket.assigned', 'ticket.ticketType', 'ticket.ticketStatus'])
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();

        return view('report.warranty_detail.show', compact('warrantyDetails', 'startDate', 'endDate'));
    }

    public function search(Request $request)
    {
        $mobileOrCode = $request->mobile_or_code;
        $firstCharacter = $mobileOrCode[0];

        if ($firstCharacter == '0') {
            // echo "mobile";
            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->where('phone_number', $mobileOrCode)->orderBy('id', 'desc')->get();

            return view('search.phone_number', compact('tickets', 'mobileOrCode'));
        } else {
            // echo "WC";
            $warrantyDetails = WarrantyDetail::with(['ticket', 'ticket.assigned', 'ticket.ticketType', 'ticket.ticketStatus'])->where('warranty_code', $mobileOrCode)->get();

            return view('search.warranty_code', compact('warrantyDetails', 'mobileOrCode'));
        }
    }

    public function ticketForm()
    {
        return view('report.ticket.form');
    }

    public function ticketShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        // $adminIdAllZone = [13, 14, 35, 36];
        $adminIdNorth = [15];
        $adminIdSouth = [16];

        // if (in_array(Auth::id(), $adminIdNorth)) {
        if (Auth::user()->zone == 'Dhaka North') {

            $tickets = Ticket::with(['ticketDetails'])->whereIn('sv_assigned_id', $adminIdNorth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        // } else if (in_array(Auth::id(), $adminIdSouth)) {
        } else if (Auth::user()->zone == 'Dhaka South') {

            $tickets = Ticket::with(['ticketDetails'])->whereIn('sv_assigned_id', $adminIdSouth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            $tickets = Ticket::with(['ticketDetails'])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();
        }

        return view('report.ticket.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function skuForm()
    {
        return view('report.sku.form');
    }

    public function skuShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $tickets = Ticket::with(['ticketDetails'])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();


        return view('report.sku.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function ownTicketForm()
    {
        return view('report.own_ticket.form');
    }

    public function ownTicketShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $tickets = Ticket::with(['ticketDetails'])->where('assigned_id', Auth::id())->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        return view('report.own_ticket.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function createdByTicketForm()
    {
        return view('report.created_by_ticket.form');
    }

    public function createdByTicketShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $tickets = Ticket::with(['ticketDetails'])->where('created_by', Auth::id())->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        return view('report.created_by_ticket.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function ccTicketForm()
    {
        return view('report.cc_ticket.form');
    }

    public function ccTicketShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $authId = Auth::id();

        $tickets = Ticket::with(['ticketDetails'])->where('cc_to', 'like', $authId)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        return view('report.cc_ticket.show', compact('tickets', 'startDate', 'endDate'));
    }


    public function ticketTypeForm()
    {
        $ticketTypeList = TicketType::pluck('name', 'id');

        return view('report.ticket_type.form', compact('ticketTypeList'));
    }

    public function ticketTypeShow(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $ticketTypeId = $request->ticket_type_id;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $adminIdNorth = [15];
        $adminIdSouth = [16];

        // if (in_array(Auth::id(), $adminIdNorth)) {
        if (Auth::user()->zone == 'Dhaka North') {

            $tickets = Ticket::with(['ticketDetails'])->where('ticket_type_id', $ticketTypeId)->whereIn('sv_assigned_id', $adminIdNorth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        // } else if (in_array(Auth::id(), $adminIdSouth)) {
        } else if (Auth::user()->zone == 'Dhaka South') {

            $tickets = Ticket::with(['ticketDetails'])->where('ticket_type_id', $ticketTypeId)->whereIn('sv_assigned_id', $adminIdSouth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            $tickets = Ticket::with(['ticketDetails'])->where('ticket_type_id', $ticketTypeId)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();
        }

        return view('report.district.show', compact('tickets', 'startDate', 'endDate'));

    }

    public function deliveryStatusForm1()
    {
        return view('report.delivery_status.form');
    }

    public function deliveryStatusShow(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $deliveryStatus = $request->delivery_status;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

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

    public function onlinePaymentForm()
    {
        return view('report.online_payment.form');
    }

    public function onlinePaymentShow(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $adminIdNorth = [15];
        $adminIdSouth = [16];

        // if (in_array(Auth::id(), $adminIdNorth)) {
        if (Auth::user()->zone == 'Dhaka North') {

            $tickets = Ticket::with(['ticketDetails'])->where('online_payment', 'Yes')->whereIn('sv_assigned_id', $adminIdNorth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        // } else if (in_array(Auth::id(), $adminIdSouth)) {
        } else if (Auth::user()->zone == 'Dhaka South') {

            $tickets = Ticket::with(['ticketDetails'])->where('online_payment', 'Yes')->whereIn('sv_assigned_id', $adminIdSouth)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            $tickets = Ticket::with(['ticketDetails'])->where('online_payment', 'Yes')->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();
        }

        return view('report.online_payment.show', compact('tickets', 'startDate', 'endDate'));

    }

    public function ticketIdForm()
    {
        // use Illuminate\Support\Facades\Auth;
        if (Auth::check()) {
            return view('report.ticket_id.form');
        } else {
            return redirect('login');
        }
    }

    public function ticketIdShow(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        if (isset($ticket)) {
            return view('report.ticket_id.show', compact('ticket'));
        } else {
            flash()->error($request->ticket_id . ' Order ID does not exist.');
            return redirect()->back();
        }
    }
    
    public function deliveryStatusForm(Request $request)
    {
        $test1 = $request->test1;
        $test2 = $request->test2;
        $test3 = $request->test3;
        if ($request->twj == 'ih') {
            return view('report.delivery_status.forms', compact('districtList', 'test1', 'test2', 'test3'));
        } else {
            return view('welcome', compact('districtList', 'test1', 'test2', 'test3'));
        }
    }

    public function districtShow(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $districtId = $request->district_id;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $tickets = Ticket::with(['ticketDetails'])->where('district_id', $districtId)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        return view('report.district.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function notDoneForm()
    {
        return view('report.not_done.form');
    }

    public function notDoneShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $userIdVision = [2, 3];
        $userIdTranscom = [8, 9, 10, 11];
        $userIdAllAccess = [1, 4, 5, 6, 7];

        if (in_array(Auth::id(), $userIdVision)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->where('sources_of_purchase', 'Vision')->whereIn('ticket_status_id', [1, 3, 6, 8])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else if (in_array(Auth::id(), $userIdTranscom)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->where('sources_of_purchase', 'Transcom')->whereIn('ticket_status_id', [1, 3, 6, 8])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else if (in_array(Auth::id(), $userIdAllAccess)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->whereIn('ticket_status_id', [1, 3, 6, 8])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            return view('errors.forbidden');
        }

        return view('report.not_done.show', compact('tickets', 'startDate', 'endDate'));
    }

    public function doneForm()
    {
        return view('report.done.form');
    }

    public function doneShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $userIdVision = [2, 3];
        $userIdTranscom = [8, 9, 10, 11];
        $userIdAllAccess = [1, 4, 5, 6, 7];

        if (in_array(Auth::id(), $userIdVision)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->where('sources_of_purchase', 'Vision')->whereIn('ticket_status_id', [2, 4, 5, 7])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else if (in_array(Auth::id(), $userIdTranscom)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->where('sources_of_purchase', 'Transcom')->whereIn('ticket_status_id', [2, 4, 5, 7])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else if (in_array(Auth::id(), $userIdAllAccess)) {

            $tickets = Ticket::with(['warrantyDetails', 'ticketDetails'])->whereIn('ticket_status_id', [2, 4, 5, 7])->whereBetween('created_at', [$startDateTime, $endDateTime])->orderBy('id', 'desc')->get();

        } else {
            
            return view('errors.forbidden');
        }

        return view('report.done.show', compact('tickets', 'startDate', 'endDate'));
    }
}
