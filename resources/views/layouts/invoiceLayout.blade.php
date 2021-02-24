
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('ldp/dist/images/logo.png')}}" type="image/icon type">
<title>Invoice</title>
<meta name="author" content="LLP Invoice">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
    <link rel="icon" href="{{asset('ldp/dist/images/logo.png')}}" type="image/icon type">
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/invoiceCSS.css')}}"/>

</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
      <img id="logo" style="height: 120px" src="{{asset('ldp/dist/images/logo.png')}}" title="Koice" alt="Koice" />
    </div>
    <div class="col-sm-5 text-center text-sm-right">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  </header>
  
  <!-- Main Content -->
  <main>
      @yield('content')
  </main>


  <!-- Footer -->
  <footer class="text-center mt-4">
  <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
  <div class="btn-group btn-group-sm d-print-none">
      <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
      {{--<a href="" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a>--}}
  </div>
  </footer>
</div>
<script src="{{asset('adm/assets/js/core/jquery.min.js')}}"></script>
<script>
    $( document ).ready(function() {
        $.ajax({
            type : 'get',
            url : '{{URL::to('initiateCartClearance')}}',
            data:{
            },
            success:function(data){
                console.log(data);
            }
        });
    });
</script>

<script>
    function onChangeTax(){
        var payable=document.getElementById("totalID").innerText;
        payable=parseInt(payable);
        if(payable>0){
            var tax=document.getElementById("taxID").value;
            if(tax==""){
                tax=0;
                document.getElementById("taxID").value=0;
            }
            tax=parseInt(tax);


            var taxAmount=(payable*tax/100);
            document.getElementById("taxField").innerText=taxAmount;
            document.getElementById("payableID").innerText=payable+taxAmount;
            var identifier=document.getElementById("saleIdentifier").value;

            $.ajax({
                type : 'get',
                url : '{{URL::to('/admin/updateInv')}}',
                data:{
                    value:taxAmount,
                    saleIdentifier:identifier
                },
                success:function(data){
                    console.log(data);
                }
            });
        }


    }
</script>
</body>
</html>
