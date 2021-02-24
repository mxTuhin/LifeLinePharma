@extends('layouts.dashboardLayout')
@section('title')
    Admin | Product List
@endsection

@section('navigationIdentifier')
    Product List
@endsection

@section('navProductList')
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
            background: #37474F;
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        }
        .hoverCard{
            transition: transform .2s; /* Animation */
        }

        .hoverCard:hover {

            transform: scale(1.1);
        }

    </style>
    <div class="content">
        <div class="container-fluid">
            @include('Admin.statCard')

            <div align="center" class="container" >
                <div class="row">
                    <div class="col-12 col-sm-12"><br>
                        <button style="border-radius: 20px; width:250px "
                                data-toggle="modal"
                                data-target="#disabledProductModal"
                                class="col-12 col-sm-3 btn btn-info">
                            Click to retrieve<br>Disabled Products
                        </button>
                    </div>
                </div>
            </div>


            <hr style="border-top: 1px dashed navajowhite;">

            <div align="center" class="container">
                <p style="color:#07d962; ">Active Products</p>
                <hr class="w-25" style="height:2px; border-width:0; color:#07d962; background-color:#07d962">

            </div>

            <div clas="row">
                <div class="container">

                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search For The Product..." id="search" name="cartSearch">
                        <button type="submit" class="btn btn-default btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>

                </div>

            </div>

            <div id="searchText" class="row">

            </div>
            <div id="preText" class="row">
                @foreach($products as $product)



                <div onclick="productModal(
                    '../assets/products/',
                    '{{$product->name}}',
                    '{{$product->category}}',
                    '{{$product->quantity}}',
                    '{{round($product->price, 2)}}',
                    '{{$product->img}}',
                    '{{$product->status}}',
                    '{{$product->id}}',
                    '{{$product->dealer_price}}'
                    )"
                     data-toggle="modal" data-target="#productModal" class="col-12 col-sm-3 clickable hoverCard">
                    <div  class="card">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <p class="card-title col-6 col-sm-6">{{$product->name}}</p>
                                <p class="card-title col-6 col-sm-6">In Stock: {{$product->quantity}}</p>
                            </div>

                            <div class="row">
                                <p style="font-size: 18px" class="card-category col-6 col-sm-6"><b>BDT: {{round($product->price, 2)}}</b></p>
                                <p  class="card-category col-6 col-sm-6"><b>Category: {{$product->category}}</b></p>
                            </div>

                        </div>
                        <div align="center" class="card-body table-responsive">

                            <img class="img-fluid" style="height: 300px;" src="../assets/products/{{$product->img}}">

                        </div>
                    </div>
                </div>



                    @endforeach

            </div>
            <div align="center" class="row">
                <div class="col-12 col-sm-12">
                    {{$products->links()}}
{{--                    {{$products->lastPage()}}--}}
                </div>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div style="color: white !important" class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content" style="background-color: #1A2035">
                <div class="modal-header">
                    <h5  class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
                    <button style="color: white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('editProduct')}}" enctype="multipart/form-data" class="login100-form">
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
                                    <input name="productID" id="productID" hidden required>
                                    <div class="form-group col-md-6">
                                        <label for="productName">Product Name</label>
                                        <input style="color: white" type="text" class="form-control" name="productName" id="productName" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category">Category</label>
                                        <select style="background-color: inherit; color: white" id="category" name="category" class="form-control">
                                            <option disabled value="chooseOption" selected>Choose a Category</option>
                                            @foreach($category as  $c)

                                                <option value="{{$c->name}}">{{$c->name}}</option>

                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inStockDis">In Stock (Quantity)</label>
                                        <input style="color: white"  type="text" class="form-control" name="quantityDis" id="inStockDis" disabled>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="inStock"> &nbsp;&nbsp; &nbsp; Add New Stock</label>
                                        <input style="color: white"  type="text" class="form-control" value="0" name="quantity" id="inStock" autofocus>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="dealer_price">Dealer Price</label>
                                        <input style="color: white" type="text" class="form-control" name="dealer_price" id="dealer_price">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="price">Retail Unit Price</label>
                                        <input style="color: white" type="text" class="form-control" name="unitPrice" id="price">
                                    </div>
                                    <div class="form-group col-md-6">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <input style="color: white" type="radio" id="activate" name="status" value="active">
                                                <label for="male">Activate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input style="color: white" type="radio" id="deactivate" name="status" value="disable">
                                                <label for="female">Deactivate</label>

                                            </div>



                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">

                                        <input type="submit" value="Update Product" class="btn btn-info w-50" >
                                        <p style="color: #07d962; font-size: 12px">Please recheck before Submit</p>
                                    </div>
                                </div>



                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="disabledProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: #1A2035">
                <div class="modal-header">
                    <h5 style="color: white" class="modal-title" id="exampleModalLongTitle">Disabled Products</h5>
                    <button style="color: white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalBody" class="row">
                        @foreach($disPro as $product)

                            <div id="disCard{{$product->id}}" onclick="disabledModal(
                                '{{$product->id}}'
                                )"
                                 class="col-12 col-sm-6 clickable hoverCard disabledCard">
                                <div  class="card">
                                    <div class="card-header card-header-primary">
                                        <div class="row">
                                            <p class="card-title col-6 col-sm-6">{{$product->name}}</p>
                                            <p class="card-title col-6 col-sm-6">In Stock: {{$product->quantity}}</p>
                                        </div>

                                        <div class="row">
                                            <p style="font-size: 18px" class="card-category col-6 col-sm-6"><b>BDT: {{round($product->price, 2)}}</b></p>
                                            <p  class="card-category col-6 col-sm-6"><b>Category: {{$product->category}}</b></p>
                                        </div>

                                    </div>
                                    <div align="center" class="card-body table-responsive">

                                        <img class="img-fluid" style="height: 150px;" src="../assets/products/{{$product->img}}">

                                    </div>
                                </div>
                            </div>



                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    @endsection

@section('dashboardJS')
    <script>
        function productModal(public_path, name, category, inStock, price, src, status, id, dealer_price){
            document.getElementById('productName').value = name;
            document.getElementById('category').value = category;
            document.getElementById('inStockDis').value = inStock;
            document.getElementById('price').value = price;
            document.getElementById('dealer_price').value = dealer_price;
            document.getElementById('productID').value = id;
            if(src!=""){
                document.getElementById("appearSpanOne").style.display = 'None';
            }
            var imgSrc= public_path+src;
            var img= document.getElementById('outputOne');
            img.src = imgSrc;
            if(status=="active"){
                document.getElementById("activate").checked = true;
            }
            else{
                document.getElementById("deactivate").checked = true;
            }

        }
    </script>

    <script>
        var loadFileOne = function(event) {
            var image = document.getElementById('outputOne');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('appearSpanOne').style.display = 'none';
        };
    </script>
    
    <script>
        function disabledModal(id) {

            $('.disabledCard').on('click',function(){
                $value=id;
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('enableProduct')}}',
                    data:{'id':$value},
                    success:function(data){
                        if(data=="success"){
                            $('#disCard'+id).remove();
                        }
                    }
                });
            })


        }
    </script>
@endsection
