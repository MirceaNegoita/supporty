@extends('layouts.app')

@section('title', 'My Invoices')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-invoice"> My Invoices</i>
                </div>

                <div class="panel-body">
                    @if ($invoices->isEmpty())
                        <p>You have not created any invoices.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Month</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>
                                        <a href="{{ url('client/invoices/'. $invoice->invoice_id) }}">
                                            #{{ $invoice->invoice_id }} - {{ $invoice->title }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->month }}</td>
                                    <td>
                                    @if ($invoice->status === 'Pending')
                                        <span class="label label-success">{{ $invoice->status }}</span>
                                    @else
                                        <span class="label label-danger">{{ $invoice->status }}</span>
                                    @endif
                                    </td>
                                    <td>{{ $invoice->updated_at }}</td>
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