@extends('layouts.app')

@section('title', 'All Invoices')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-invoice"> Invoices</i>
                </div>

                <div class="panel-body">
                    @if ($invoices->isEmpty())
                        <p>There are currently no invoices.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Month</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th style="text-align:center" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->mont }}></td>
                                    <td>
                                        <a href="{{ url('client/invoices/'. $invoice->invoice_id) }}">
                                            #{{ $invoice->invoice_id }} - {{ $invoice->title }}
                                        </a>
                                    </td>
                                    <td>
                                    @if ($invoice->status === 'Pending')
                                        <span class="label label-success">{{ $invoice->status }}</span>
                                    @else
                                        <span class="label label-danger">{{ $invoice->status }}</span>
                                    @endif
                                    </td>
                                    <td>{{ $invoice->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('invoices/' . $invoices->invoice_id) }}" class="btn btn-primary">Comment</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('billing/pay_invoice/' . $invoice->invoice_id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">Close</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $invoices->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection