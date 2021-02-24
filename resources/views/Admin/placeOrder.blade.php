@extends('layouts.dashboardLayout')

@section('title')
    Admin | Place Order
@endsection

@section('navigationIdentifier')
    Place Order
@endsection

@section('navPlaceOrder')
    active
@endsection

@section('content')

    <style>
        .hoverCard{
            transition: transform .2s; /* Animation */
        }

        .hoverCard:hover {

            transform: scale(1.1);
        }
        #cancelDiscount{
            display: none;
        }
    </style>

    <div class="content">
        <div class="container-fluid">

            @include('Admin.statCard')
            <div class="row">
                <div class="col-3 col-sm-4">

                </div>
                <div class="col-6 col-sm-4">
                    <div align="center" class="container">
                        <p style="color:#07d962; ">Place Order</p>

                        <hr style="height:2px; width: 150px; border-width:0; color:#07d962; background-color:#07d962">
                    </div>

                </div>
                <div class="col-3 col-sm-4">

                </div>

            </div>

            <div clas="row">
                <div class="container">

                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search For The Product..." id="cartSearch" name="cartSearch">
                            <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>

                </div>

            </div>

            <div id="searchText" class="row">
                <div class="col-2 col-sm-4">

                </div>
                <div class="col-8 col-sm-4">
                    <div align="center" class="container">
                        Products Will Appear Here on Search...
                    </div>

                </div>
                <div class="col-2 col-sm-4">

                </div>
            </div>
        <br><br>
            <div class="row">
                <div class="col-3 col-sm-4">

                </div>
                <div class="col-6 col-sm-4">
                    <div align="center" class="container">
                        <p style="color:#07d962; ">Product Cart</p>

                        <hr style="height:2px; width: 150px ; border-width:0; color:#07d962; background-color:#07d962">
                    </div>

                </div>
                <div class="col-3 col-sm-4">

                </div>

            </div>

            <div id="cartSection" class="row">
                <div id="productLister" class="col-12 col-sm-8">
                    @foreach($cartProds as $cartProd)
                        <div  id="productRow{{$cartProd->id}}" class="row">
                            <div align="center" class="col-1 col-sm-1">
                                <button
                                    class="clickable" onclick="removeFromCart('{{$cartProd->id}}')"
                                    style="margin-top: 20px
                                    ;border-radius: 20px
                                    ;background: #0290A2
                                    ;background-repeat:no-repeat
                                    ;border:none
                                    ;height: 35px
                                    ;width: 35px !important; ">
                                    <span style="font-size:12px; color:white; margin-top: -15px !important; " >
                                        <i class="far fa-trash-alt"></i>
                                    </span>

                                </button>
                            </div>

                            <div align="center" class="col-3 col-sm-3">
                                <img src="../assets/products/{{$cartProd->img}}" id="productRowIMG" style="height: 60px; margin-top:10px">
                            </div>

                            <div class="col-3 col-sm-3">
                                <p id="productRowName">{{$cartProd->name}}</p>
                                <p id="productRowNCategory">{{$cartProd->category}}</p>
                            </div>

                            <div class="col-2 col-sm-2">
                                <p style="color:#4cd4e0; font-size: 22px" id="productRowPrice">${{round($cartProd->price, 2)}}</p>
                                <p style="color:#4cd4e0; font-size: 16px" id="productRowPrice">In Stock: {{$cartProd->quantity}}</p>

                            </div>

                            <div class="col-3 col-sm-3">
                                <div class="row">
                                    <div style="margin-top: 15px"
                                         class="col-3 col-sm-3">
                                        <button onclick="decrementQTY('{{$cartProd->id}}')"
                                                style=" background: rgba(196, 96, 96, 0.3)
                                                                       ;background-repeat:no-repeat
                                                                       ;border:none
                                                                       ;height: 35px
                                                                       ;width: 35px !important; ">
                                                                   <span style="font-size:25px; color:white " >
                                                                       -
                                                                   </span>
                                        </button>
                                    </div>

                                    <div class="col-4 col-sm-4">
                                        <input onchange="onChangePrompt('{{$cartProd->id}}')" type="number" class="form-control"
                                               style="border:1px solid
                                                                      rgba(197, 208, 209, 0.3) ;
                                                                      color: white;
                                                                      width: 55px;
                                                                      font-size: 14px;
                                                                      margin-top: 15px;
                                                                      padding-left:12px"
                                               value="{{$cartQTY[$loop->iteration-1]}}"
                                               id="qty{{$cartProd->id}}">
                                    </div>

                                    <div style="margin-top: 15px"
                                         class="col-3 col-sm-3">
                                        <button onclick="incrementQTY('{{$cartProd->id}}')"
                                                style=" background: rgba(59, 179, 153, 0.3) ;
                                                                       background-repeat:no-repeat;
                                                                       border:none;
                                                                       height: 35px;
                                                                       width: 35px !important; ">
                                                                   <span style="font-size:25px; color:white; margin-top: -15px !important; " >
                                                                       +
                                                                   </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr class="w-50" style="height:2px; border-width:0;  background-color:rgba(76, 212, 224, 0.3)">
                        </div>
                    @endforeach
                </div>

                <div class="col-12 col-sm-4">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="container" align="center">
                                <h4 >Order Summary</h4>
                            </div>

                        </div>

                        <div class="col-12 col-sm-12">
                            <div id="cartTotal">

                            </div>
                        </div>
                        <br><br>
                        <div class="col-12 col-sm-12">
                                <div class="row">
                                    <div  class="form-group col-8 col-sm-8">
                                        <input type="text" class="form-control" id="discountName" name="cartVoucher" placeholder="Enter Voucher/Discount Code" id="cartVoucher">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <button onclick="addDiscount()" id="applyVoucher" class="btn btn-info">Apply</button>
                                    </div>
                                </div>
                        </div>
                        <div  class="col-12 col-sm-12">

                            <div class="row">
                                <div id="payableAmount" style="padding-top: 12px" class="col-8 col-sm-8" >

                                </div>
                                <div class="col-4 col-sm-4" >
                                    <button id="cancelDiscount" onclick="clearCartCondition()" type="button" class="btn btn-warning">
                                        Cancel
                                    </button>
                                </div>
                            </div>



                        </div>
                        <br><br>
                        <div class="col-12 col-sm-12">
                            <div class="container" align="center">
                                <button style="width: 200px" onclick="setCustomerName()" class="btn btn-info">
                                    Proceed to Checkout
                                </button>
                            </div>

                        </div>

                    </div>



                </div>

            </div>


        </div>
    </div>





@endsection

@section('dashboardJS')



    <script type="text/javascript">
        $('#cartSearch').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('cartSearchBlock')}}',
                data:{'search':$value},
                success:function(data){
                    $('#searchText').html(data);
                }
            });
        })
    </script>


    <script>
        function addNode(public_path, name, category, price, src, id, qty) {
            addToCart(public_path, name, category, price, src, id, qty);

        }

    </script>

    <script>
        function publishNode(public_path, name, category, price, src, id, qty){
            document.getElementById("productLister").style.border = '1px solid rgba(76, 212, 224, 0.3)';
            var quantity=1;


            var node = document.createElement('div');

            node.innerHTML = '<div  id="productRow'+id+'" class="row">\n' +
                '<div align="center" class="col-1 col-sm-1"><button class="clickable" onclick="removeFromCart(\''+id+'\')" style="margin-top: 20px ;border-radius: 20px ;background: #0290A2 ; background-repeat:no-repeat; ;border:none; height: 35px; width: 35px !important; ">\n' +
                '<span style="font-size:12px; color:white; margin-top: -15px !important; " ><i class="far fa-trash-alt"></i></span> ' +
                '</button></div> ' +
                '                        <div align="center" class="col-3 col-sm-3">\n' +
                '                            <img src="'+public_path+src+'" id="productRowIMG" style="height: 60px; margin-top:10px">\n' +
                '\n' +
                '                        </div>\n' +
                '\n' +
                '                        <div class="col-3 col-sm-3">\n' +
                '                            <p id="productRowName">'+name+'</p>\n' +
                '                            <p id="productRowNCategory">'+category+'</p>\n' +
                '\n' +
                '\n' +
                '                        </div>\n' +
                '                        <div class="col-2 col-sm-2">\n' +
                '                            <p style="color:#4cd4e0; font-size: 22px" id="productRowPrice">$'+price+'</p>\n' +
                '<p style="color:#4cd4e0;; font-size: 16px" id="productRowPrice">In Stock: '+qty+'</p>' +
                '\n' +
                '                        </div>\n' +
                '                        <div class="col-3 col-sm-3">\n<div class="row">' +
                '<div style="margin-top: 15px" class="col-3 col-sm-3"><button onclick="decrementQTY(\''+id+'\')" style=" background: rgba(196, 96, 96, 0.3) ; background-repeat:no-repeat;border:none; height: 35px; width: 35px !important; ">'+
                '<span style="font-size:25px; color:white " >-</span>' +
                '</button></div>' +
                '<div class="col-4 col-sm-4">' +
                '                            <input onchange="onChangePrompt(\''+id+'\')" type="number" class="form-control" ' +
                'style="border:1px solid ' +
                'rgba(197, 208, 209, 0.3) ;' +
                'color: white; ' +
                'width: 55px; font-size: 14px; margin-top: 15px; padding-left:12px" ' +
                'value="'+quantity+'" ' +
                'id="qty'+id+'"></div>' +
                '<div style="margin-top: 15px" class="col-3 col-sm-3"><button onclick="incrementQTY(\''+id+'\')" style=" ;background: rgba(59, 179, 153, 0.3) ; background-repeat:no-repeat; ;border:none; height: 35px; width: 35px !important; ">' +
                '<span style="font-size:25px; color:white; margin-top: -15px !important; " >+</span>' +
                '</button></div>\n' +
                '\n' +
                '                        </div>\n' +
                '\n' +
                '\n' +
                '                    </div><hr class="w-50" style="height:2px; border-width:0;  background-color:rgba(76, 212, 224, 0.3)">'


            document.getElementById("productLister").appendChild(node);
        }
    </script>

    <script>
        function decrementQTY(id){
            document.getElementById("qty"+id).stepDown(1);
            if(document.getElementById("qty"+id).value < 1){
                document.getElementById("qty"+id).value =1;
            }else{
                updateQuantity(id, -1);
            }
        }
    </script>

    <script>
        function incrementQTY(id){
            document.getElementById("qty"+id).stepUp(1);
            updateQuantity(id, 1);

        }
    </script>

    <script>
        function removeFromCart(id){
            $( "#productRow"+id).remove();
            $.ajax({
                type : 'get',
                url : '{{URL::to('removeFromCart')}}',
                data:{'rowID':id,
                },
                success:function(data){
                    console.log(data);
                }
            });
            placeTotal();
        }
    </script>

    <script>
        function addToCart(public_path, name, category, price, src, id, qty){
            if(qty>0){
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('addToCart')}}',
                    data:{'rowID':id,
                        'prodName':name,
                        'prodPrice':price
                    },
                    success:function(data){
                        console.log(data.total);
                        if(data.status!="notValidate"){
                            publishNode(public_path, name, category, price, src, id, qty);
                        }
                        else{
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'The Item is already Added',
                                showConfirmButton: true,
                                timer: 1500,
                            })
                        }
                    }
                });
                placeTotal();
            }
            else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Out of Stock',
                    showConfirmButton: true,
                    timer: 2500,
                })
            }

        }
    </script>
    <script>
        function onChangePrompt(id){
            var value=document.getElementById("qty"+id).value;
            if(value<=0){
                $("#qty"+id).val(1);
                value=1;
            }
            $.ajax({
                type : 'get',
                url : '{{URL::to('replaceCartQuantity')}}',
                data:{'rowID':id,
                    'qty':value
                },
                success:function(data){
                    console.log(data);
                }
            });
            placeTotal();
        }
    </script>

    <script>
        function updateQuantity(id, value){
            $.ajax({
                type : 'get',
                url : '{{URL::to('updateCartQuantity')}}',
                data:{'rowID':id,
                    'qty':value
                },
                success:function(data){
                    console.log(data);
                }
            });
            placeTotal();
        }
    </script>

    <script>
        $( document ).ready(function() {
            placeTotal();

        });
    </script>

    <script>
        function placeTotal(){
            $.ajax({
                type : 'get',
                url : '{{URL::to('getSubTotal')}}',
                data:{
                },
                success:function(data){
                    document.getElementById("cartTotal").innerText="Cart Total: ৳ "+data;


                }
            });
            placeCartTotal();
        }
    </script>

    <script>
        function placeCartTotal(){
            $.ajax({
                type : 'get',
                url : '{{URL::to('getCartTotal')}}',
                data:{
                },
                success:function(data){
                    document.getElementById("payableAmount").innerText="Payable Amount ৳ "+Math.floor(data.total)+""+data.disStatus;
                    if(data.disStatus!=""){
                        document.getElementById('cancelDiscount').style.display='block';
                    }
                    else{
                        document.getElementById('cancelDiscount').style.display='none';
                    }

                }
            });
        }
    </script>

    <script>
        function addDiscount(){
            var name=document.getElementById("discountName").value;
            $.ajax({
                type : 'get',
                url : '{{URL::to('cartDiscount')}}',
                data:{
                    value: name
                },
                success:function(data){
                    console.log(data)
                }
            });
            $("#discountName").val('');
            placeCartTotal();
        }
    </script>

    <script>
        function clearCartCondition(){
            $.ajax({
                type : 'get',
                url : '{{URL::to('clearCartCondition')}}',
                data:{
                    value: name
                },
                success:function(data){
                    console.log(data)
                }
            });
            placeCartTotal();
        }
    </script>

    {{--<script>
        function setCustomerName(){
            var status="null";
            Swal.fire({
                title: 'Type Customer Name',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (customerName) => {
                    $.ajax({
                        type : 'get',
                        url : '{{URL::to('checkout')}}',
                        data:{
                            value: customerName
                        },
                        success:function(data){
                            console.log(data);
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                Swal.fire({
                    icon: 'success',
                    title: "Creating Invoice",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    html: 'Redirecting in <strong>3</strong> seconds...',
                    timer: 3000,
                    onBeforeOpen: () => {
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector(
                                'strong')
                                .textContent = (Swal
                                .getTimerLeft() / 1000)
                                .toFixed(0)
                        }, 1000)
                    },
                    onClose: () => {

                        clearInterval(timerInterval)
                        window.location.replace('../admin/invoice');
                    }
                });

            })
        }
    </script>--}}

    <script>
        function setCustomerName(){
            Swal.mixin({
                input: 'text',
                confirmButtonText: 'Next &rarr;',
                showCancelButton: true,
                progressSteps: ['1', '2']
            }).queue([
                {
                    title: 'Type Customer Name',
                },
                'Type Cell Number'
            ]).then((result) => {
                if (result.value) {

                    $.ajax({
                        type : 'get',
                        url : '{{URL::to('checkout')}}',
                        data:{
                            name: result.value[0],
                            cellnum: result.value[1]
                        },
                        success:function(data){
                            if(data.status){
                                console.log(data);
                                Swal.fire({
                                    icon: 'success',
                                    title: "Creating Invoice",
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    html: 'Redirecting in <strong>3</strong> seconds...',
                                    timer: 3000,
                                    onBeforeOpen: () => {
                                        timerInterval = setInterval(() => {
                                            Swal.getContent().querySelector(
                                                'strong')
                                                .textContent = (Swal
                                                .getTimerLeft() / 1000)
                                                .toFixed(0)
                                        }, 1000)
                                    },
                                    onClose: () => {
                                        window.open('../admin/invoice');
                                        clearInterval(timerInterval)
                                        setTimeout(function(){ window.location.replace('../admin/placeOrder'); }, 1000)


                                    }
                                });

                            }
                        }
                    });
                }
            })
        }
    </script>



@endsection
