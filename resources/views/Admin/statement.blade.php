@extends('layouts.statementLayout')
@section('statementName')
    Account Statement
    @endsection
@section('content')
    <div class="row">
        <div class="col-sm-6"><strong>Generated At:</strong> {{date("d.m.Y")}} | {{date("h:i:sa")}}</div>

    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Statement Of:</strong>
            <address>
                {{config('app.name')}}  <br/>
                Rabeya Latif Market<br />

            </address>
        </div>
        <div class="col-sm-6 order-sm-0"> <strong>Generated By:</strong>
            <address>
                {{Auth::guard('admin')->user()->firstname}}<br />
                {{Auth::guard('admin')->user()->cellnum}}<br />
            </address>
        </div>
    </div>


    <table  class="table table-striped">
        <thead>
        <tr>
            <th scope="col"><div align="left">Date</div></th>
            <th scope="col"><div align="center">Invoice No</div></th>

            <th scope="col"><div align="center">Sold To</div></th>
            <th scope="col"><div align="center">Product Cost</div></th>
            <th scope="col"><div align="center">Received</div></th>
            <th scope="col"><div align="center">Profit</div></th>


            <!--<th scope="col"><div align="center">Action</div></th>-->
        </tr>
        </thead>
        <tbody>
        @foreach($inv as $item)
            <tr >

                <td scope="row"><strong>{{$item->date}}</strong></td>
                <td><div align="center">Inv-{{$item->id}}</div></td>
                <td><div align="center">{{$item->customername}}</div></td>

                <td><div align="center">{{$item->product_cost}}</div></td>
                <td><div align="center">{{$item->total}}</div></td>
                <td><div align="center">{{$item->total - $item->product_cost}}</div></td>

            </tr>
        @endforeach

        <tr>
            <td colspan="5" class="bg-light-2 text-right"><strong>Total Profit:</strong></td>
            <td class="bg-light-2 text-center">{{$inv->sum('total')-$inv->sum('product_cost')}}</td>
        </tr>

        </tbody>
    </table>

    @endsection
