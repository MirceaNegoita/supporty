<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\TicketCategory;
use App\Mailers\AppMailer;

class TicketsController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function index(){
        $tickets = Ticket::paginate(10);
        $categories = TicketCategory::all();

        return view('technical.tickets.index', compact('tickets', 'categories'));
    }

    public function create(){
        $categories = TicketCategory::all();

        return view('client.tickets.create', compact('categories'));
    }

    public function store(Request $request, AppMailer $mailer){

        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message'  => 'required',
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => 'Open',
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID #$ticket->ticket_id has been opened.");
    }

    public function userTickets(){
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = TicketCategory::all();

        return view('client.tickets.user_tickets', compact('tickets', 'categories'));
    }

    public function show($ticket_id){
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $category = $ticket->category;
        $comments = $ticket->comments;
        return view('client.tickets.show', compact('ticket', 'category', 'comments'));
    }

    public function close($ticket_id, AppMailer $mailer){
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = 'Closed';
        $ticket->save();
        $ticketOwner = $ticket->user;
        
        //Send Ticket Notification to owner
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");

    }
}
