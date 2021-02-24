@extends('layouts.dashboardLayout')

@section('title')
    Admin | Update Product
@endsection

@section('navigationIdentifier')
    Update Product
@endsection

@section('navUpdateProduct')
    active
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">

            @include('Admin.statCard')
            <div class="row">
                <div class="col-3 col-sm-4">

                </div>
                <div class="col-6 col-sm-4">
                    <div align="center" class="container">
                        <p style="color:#07d962; ">Search Product</p>

                        <hr style="height:2px; width: 150px; border-width:0; color:#07d962; background-color:#07d962">
                    </div>

                </div>
                <div class="col-3 col-sm-4">

                </div>

            </div>

            <div clas="row">
                <div class="container">

                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search For The Product..." id="updateSearch" name="cartSearch">
                        <button type="submit" class="btn btn-default btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>

                </div>

            </div>
            <table  class="table">
                <thead>
                <tr>
                    <th style="width: 450px" scope="col"><div align="left">Item Name</div></th>
                    <th scope="col"><div align="center">Category</div></th>

                    <th scope="col"><div align="center">Dealer Price</div></th>
                    <th scope="col"><div align="center">Retail Price</div></th>
                    <th scope="col"><div align="center">Quantity</div></th>

                    <!--<th scope="col"><div align="center">Action</div></th>-->
                </tr>
                </thead>
                <tbody id="searchText">

                </tbody>
                <tbody id="preText">
                    @foreach($products as $item)
                        <tr>
                            <td scope="row">
                                <input onchange="onChangeField('{{$item->id}}', 'name')" style="width: 350px" type="text"
                                       class="form-control" placeholder="Dealer Price"
                                       value="{{$item->name}}"
                                       id="name{{$item->id}}">

                                </td>
                            <td><div align="center">{{$item->category}}</div></td>
                            <td>
                                <div align="center">
                                    <input onchange="onChangeField('{{$item->id}}', 'dealer_price')" style="width: 100px" type="number"
                                           class="form-control" placeholder="Dealer Price"
                                           value="{{$item->dealer_price}}"
                                           id="dealer_price{{$item->id}}">
                                </div>
                            </td>

                            <td>
                                <div align="center">
                                    <input onchange="onChangeField('{{$item->id}}', 'price')" style="width: 100px" type="number"
                                           class="form-control" placeholder="Retail Price"
                                           value="{{$item->price}}"
                                           id="price{{$item->id}}">
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <div style="width: 250px" class="row">
                                        <div class="col-6 col-sm-6">
                                            <span style="font-size: 14px">In Stock: <span style="color: whitesmoke;" id="qty{{$item->id}}">{{$item->quantity}}</span></span>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <span>
                                                    <input onchange="onChangeField('{{$item->id}}', 'quantity')" style="width: 100px" type="number"
                                                           class="form-control" placeholder="Add Stock"
                                                           value=""
                                                           id="quantity{{$item->id}}">
                                            </span>
                                        </div>



                                    </div>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div align="center" class="row">
                <div class="col-12 col-sm-12">
                    {{$products->links()}}
                    {{--                    {{$products->lastPage()}}--}}
                </div>
            </div>





        </div>
    </div>
@endsection
@section('dashboardJS')
    <script type="text/javascript">
        $('#updateSearch').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('updateSearch')}}',
                data:{'search':$value},
                success:function(data){
                    $('#searchText').html(data);
                    if(data==""){
                        document.getElementById("searchText").style.display="none";
                        document.getElementById("preText").style.display="table-row-group";
                    }
                    else{
                        document.getElementById("searchText").style.display="table-row-group";
                        document.getElementById("preText").style.display="none";
                    }
                }
            });
        })
    </script>

    <script>
        function onChangeField(id, fieldName){
            var value=document.getElementById(fieldName+id).value;
            $.ajax({
                type : 'get',
                url : '{{URL::to('/admin/batchUpdate/')}}',
                data:{
                    'rowID':id,
                    'instance':value,
                    'column':fieldName
                },
                success:function(data){
                    console.log(data);
                }
            });
            if(fieldName=="quantity"){
                var qty=document.getElementById("qty"+id).innerText;
                document.getElementById("qty"+id).innerText=parseInt(qty)+parseInt(value);
                document.getElementById("quantity"+id).value="";
            }
        }
    </script>
@endsection
