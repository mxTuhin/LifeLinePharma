
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Not Found</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 600;
            color: #343434;
        }

        .error_section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-image: linear-gradient(-225deg, #1A1A1A, #343434);
        }
        .error_section_subtitle {
            color: #25F193;
            text-transform: uppercase;
            letter-spacing: 5pt;
            font-weight: 500;
            font-size: 0.8rem;
            margin-bottom: -5em;
        }
        .error_section .error_title {
            --x-shadow: 0;
            --y-shadow: 0;
            --x:50%;
            --y:50%;
            font-size: 15rem;
            transition: all 0.2s ease;
            position: relative;
            padding: 2rem;
        }
        .error_section .error_title:hover {
            transition: all 0.2s ease;
            text-shadow: var(--x-shadow) var(--y-shadow) 10px #1A1A1A;
        }
        .error_section .error_title p {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background-image: radial-gradient(circle closest-side, rgba(255, 255, 255, 0.4), transparent);
            background-position: var(--x) var(--y);
            background-repeat: no-repeat;
            text-shadow: none;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.1s ease;
        }

        .btn {
            padding: 0.8em 1.5em;
            border-radius: 99999px;
            background-image: linear-gradient(to top, #32C983, #25F193);
            box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.2), inset 0px -2px 5px 0px rgba(0, 0, 0, 0.2);
            border: none;
            cursor: pointer;
            text-shadow: 0px 1px #343434;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5pt;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            transition: ease-out 0.2s all;
        }
        .btn:hover {
            text-shadow: 0px 1px 1px #343434;
            transform: translateY(-5px);
            box-shadow: 0px 4px 15px 2px rgba(0, 0, 0, 0.1), inset 0px -3px 7px 0px rgba(0, 0, 0, 0.2);
            transition: ease-out 0.2s all;
        }

    </style>
</head>
<body>



<section class="error_section">
    <p class="error_section_subtitle">

        @if(trim($exception->getMessage())=="701")
            Error Connecting Server

        @elseif(trim($exception->getMessage())=="702")
            Data Entry Error
        @elseif(trim($exception->getMessage())=="703")
            Database Error
        @elseif(trim($exception->getMessage())=="704")
            Database Error
        @elseif(trim($exception->getMessage())=="707")
            Session Blocked
        @else
            Not Found
        @endif




    </p>
    <h1 class="error_title" style="color: rgba(209, 209, 209, 0.3)">
        <p>{{trim($exception->getMessage())}}
            @if(trim($exception->getMessage())=="")
                404
            @endif</p>
        {{trim($exception->getMessage())}}
        @if(trim($exception->getMessage())=="")
            404
        @endif
    </h1>
    @if(trim($exception->getMessage())=="701")
        <a  href="{{route('adminLogin')}}" class="btn btn-info ">Back to Login</a>

        @elseif(trim($exception->getMessage())=="702")
            <a  href="{{route('addProduct')}}" class="btn btn-info ">Return to Add Products</a>
    @elseif(trim($exception->getMessage())=="703")
        <a  href="{{route('addProduct')}}" class="btn btn-info ">Could Not Connect with Database</a>
    @elseif(trim($exception->getMessage())=="704")
        <a  href="{{route('addProduct')}}" class="btn btn-info ">Invoice Not Available</a>
    @elseif(trim($exception->getMessage())=="707")
        <a href="{{route('resetPassView')}}" class="btn btn-info ">Try Again</a>
    @endif
</section>

<script>


    const title = document.querySelector('.error_title')


    //////// Light //////////
    document.onmousemove = function(e) {
        let x = e.pageX - window.innerWidth/2;
        let y = e.pageY - window.innerHeight/2;

        title.style.setProperty('--x', x + 'px')
        title.style.setProperty('--y', y + 'px')
    }

    ////////////// Shadow ///////////////////
    title.onmousemove = function(e) {
        let x = e.pageX - window.innerWidth/2;
        let y = e.pageY - window.innerHeight/2;

        let rad = Math.atan2(y, x).toFixed(2);
        let length = Math.round(Math.sqrt((Math.pow(x,2))+(Math.pow(y,2)))/10);

        let x_shadow = Math.round(length * Math.cos(rad));
        let y_shadow = Math.round(length * Math.sin(rad));

        title.style.setProperty('--x-shadow', - x_shadow + 'px')
        title.style.setProperty('--y-shadow', - y_shadow + 'px')

    }
</script>
</body>
</html>
