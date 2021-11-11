<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function dbAssigned()
    {
    	return $this->belongsTo(User::class, 'db_assigned_id');
    }

    public function svAssigned()
    {
    	return $this->belongsTo(User::class, 'sv_assigned_id');
    }

    public function ticketDetails()
    {
        return $this->hasMany('App\Models\TicketDetail', 'ticket_id');
    }
}
