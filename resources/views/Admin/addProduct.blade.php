@extends('layouts.dashboardLayout')

@section('title')
    Admin | Add Product
@endsection

@section('navigationIdentifier')
    Add Product
@endsection

@section('navAddProduct')
    active
@endsection

@section('content')
    <style>
        input[type="file"] {
            display: none;
        }
        #profile-img-tag{
            display:none;
        }
        .custom-file-upload {
            border: 1px solid #FFFFFF;
            display: inline-block;
            padding: 4px 12px;
            cursor: pointer;
            border-radius: 20% ;
        }

        select option {
            margin: 40px;
            background: #1A2035;
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        }
        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
    <div class="content">
        <div class="container-fluid">

            @include('Admin.statCard')
            <div align="center" class="container">
                <p style="color:#07d962; ">Add New Products Here</p>
                <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

            </div>
            <br>


            <form method="POST" action="{{route('storeProduct')}}" enctype="multipart/form-data" class="login100-form">
                @csrf
                <div align="center" class="row">
                    <div class="col-12 col-sm-6">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div  style="height:350px; width:350px; border:1px solid #919191; border-radius: 20px; ">
                                    <img class="img-fluid" id="outputOne">
                                    <span id="appearSpanOne" style="color: #07d962;" ><b>Image will appear here</b></span>



                                </div>
                            </div>
                            <div  class="col-12 col-sm-12">
                                <label id="profile_image" for="file-upload" class="btn btn-info ">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Select Image
                                </label>
                                <input name="image" id="file-upload" type="file" onchange="loadFileOne(event)">
                            </div>
                        </div>


                    </div>
                    <div class="col-12 col-sm-6">
                        <div style="padding: 10px" class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" name="productName" id="productName">
                                @error('productName')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category</label>
                                <select style="background-color: inherit" id="category" name="category" class="form-control">
                                    <option disabled value="chooseOption" selected>Choose a Category</option>
                                    @foreach($category as  $c)

                                        <option value="{{$c->name}}">{{$c->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inStock">In Stock (Quantity)</label>
                                <input type="text" class="form-control" name="quantity" id="inStock">

                            </div>

                            <div class="form-group col-md-4">
                                <label for="dealer_price">Dealer Price</label>
                                <input type="text" class="form-control" name="dealer_price" id="dealer_price">
                                @error('dealer_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price">Retail Unit Price</label>
                                <input type="text" class="form-control" name="unitPrice" id="price">
                                @error('unitPrice')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">

                                <input style="width: 150px" type="submit" value="Add Product" class="btn btn-info" >
                                <p style="color: #07d962; font-size: 12px">Please recheck before Submit</p>
                            </div>
                        </div>
                    </div>


                </div>

            </form>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div align="center" class="container">
                        <p style="color:#07d962; ">Add Category Here</p>
                        <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

                    </div>

                    <form id="catForm" method="POST" action="{{route('addCategory')}}" class="login100-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6 col-sm-6">

                                <input type="text" class="form-control" name="categoryName" placeholder="Add Category Here" id="categoryName">
                                @error('categoryName')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-6 col-sm-6">

                                <input style="width: 150px" type="submit" form="catForm" value="Add Category" class="btn btn-info" >

                            </div>
                        </div>

                    </form>

                </div>
                <div class="col-12 col-sm-6">

                    <div align="center" class="container">
                        <p style="color:#07d962; ">Search Invoice Here</p>
                        <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

                    </div>

                        <div class="row">
                            <div class="form-group col-6 col-sm-6">

                                <input type="text" class="form-control" name="invoiceNo" placeholder="Type Invoice Number" id="invoiceNo">

                            </div>
                            <div class="form-group col-6 col-sm-6">

                                <button style="width: 150px" onclick="generateInvoice()" type="button" class="btn btn-info " > Search Invoice</button>

                            </div>
                        </div>


                </div>

                <div class="col-12 col-sm-6">

                    <div align="center" class="container">
                        <p style="color:#07d962; ">Generate Sales Report</p>
                        <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

                    </div>

                    <div class="row">
                        <div class="form-group col-6 col-sm-4">
                            <label for="preDateSales">From</label>
                            <input type="date"  class="form-control" name="preDate" id="preDateSales">

                        </div>
                        <div class="form-group col-6 col-sm-4">
                            <label for="postDateSales">To</label>
                            <input type="date" class="form-control" name="postDate" id="postDateSales">

                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <div align="center" class="container">
                                <button style="width: 150px" onclick="generateSalesAndStock()" type="button" class="btn btn-info " >Generate</button>
                            </div>

                        </div>
                    </div>


                </div>


                <div class="col-12 col-sm-6">

                    <div align="center" class="container">
                        <p style="color:#07d962; ">Generate Statement</p>
                        <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

                    </div>

                    <div class="row">
                        <div class="form-group col-6 col-sm-4">
                            <label for="preDateStmt">From</label>
                            <input type="date"  class="form-control" name="preDate" id="preDateStmt">

                        </div>
                        <div class="form-group col-6 col-sm-4">
                            <label for="postDateStmt">To</label>
                            <input type="date" class="form-control" name="postDate" id="postDateStmt">

                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <div align="center" class="container">
                                <button style="width: 150px" onclick="generateStatement()" type="button" class="btn btn-info " >Generate</button>
                            </div>

                        </div>
                    </div>


                </div>
            </div>



        </div>
    </div>
    @endsection
@section('dashboardJS')
    <script>
        var loadFileOne = function(event) {
            var image = document.getElementById('outputOne');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('appearSpanOne').style.display = 'none';
        };
    </script>
    <script>
        function generateInvoice(){
            var inv=document.getElementById("invoiceNo").value;
            window.open('../admin/generateInv?invNo='+inv);
        }
    </script>
    <script>
        function generateSalesReport(){

        }
    </script>

    <script>
        function generateStatement(){
            var PreDate=document.getElementById("preDateStmt").value;
            var PostDate=document.getElementById("postDateStmt").value;
            $.ajax({
                type : 'get',
                url : '{{URL::to('/admin/generateStatement')}}',
                data:{
                    'preDate':PreDate,
                    'postDate':PostDate
                },
                success:function(data){
                    console.log(data)
                }
            });
            window.open('../admin/statementView');

        }
    </script>

    <script>
        function generateSalesAndStock(){
            var PreDate=document.getElementById("preDateSales").value;
            var PostDate=document.getElementById("postDateSales").value;
            $.ajax({
                type : 'get',
                url : '{{URL::to('/admin/generateSalesAndStock')}}',
                data:{
                    'preDate':PreDate,
                    'postDate':PostDate
                },
                success:function(data){
                    console.log(data)
                }
            });
            window.open('../admin/ssView');

        }
    </script>
    @endsection
