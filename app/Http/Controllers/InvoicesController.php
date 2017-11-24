<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invoices;
use App\Mailers\AppMailer;

class InvoicesController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function index(){
        $invoices = Invoices::paginate(10);

        return view('billing.invoices.index', compact('invoices'));
    }

    public function create(){
        return view('billing.invoices.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'month' => 'required',
            'message' => 'required',
        ]);

        $invoice = new Invoices([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'invoice_id' => strtoupper(str_random(10)),
            'month' =>  $request->input('month'),
            'message' => $request->input('message'),
            'status' => 'Pending',
        ]);

        $invoice->save();

        return redirect()->back()->with("status", "A invoice with ID #$invoice->invoice_id has been generated.");
    }

    public function userInvoices(){
        $invoices = Invoices::where('user_id', Auth::user()->id)->paginate(10);

        return view('client.invoices.user_invoices', compact('invoices'));
    }

    public function show($invoice_id){
        $invoice = Invoices::where('invoice_id', $invoice_id)->firstOrFail();
        $comments = $invoice->comments;
        return view('client.invoices.show', compact('invoice', 'comments'));
    }

    public function pay($invoice_id){
        $invoice = Invoices::where('invoice_id', $invoice_id)->firstOrFail();
        $invoice->status = 'Paid';
        $invoice->save();
        
        return redirect()->back()->with("status", "The invoice has been paid");
    }
}
