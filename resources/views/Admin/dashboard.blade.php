@extends('layouts.dashboardLayout')

@section('title')
    Admin | Dashboard
@endsection

@section('navigationIdentifier')
    Dashboard
    @endsection

@section('navDashboard')
    active
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('Admin.statCard')
            <div align="center" class="container" >
                <div class="row">
                    <div class="col-12 col-sm-12"><br>
                        <a href="{{route('placeOrder')}}" style="border-radius: 20px; width:250px " class="btn btn-primary "> <i class="material-icons">add_shopping_cart</i> Place Order</a>
                    </div>
                </div>



            </div>

        </div>
    </div>



    @endsection
