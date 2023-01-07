<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FormWizard_v1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="colorlib.com" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body{
            background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
        }
        .contact-form{
            background: #fff;
            margin-top: 10%;
            margin-bottom: 5%;
            width: 70%;
        }
        .contact-form .form-control{
            border-radius:1rem;
        }
        .contact-image{
            text-align: center;
        }
        .contact-image img{
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }
        .contact-form form{
            padding: 14%;
        }
        .contact-form form .row{
            margin-bottom: -7%;
        }
        .contact-form h3{
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #0062cc;
        }
        .contact-form .btnContact {
            width: 50%;
            border: none;
            border-radius: 1rem;
            padding: 1.5%;
            background: #dc3545;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }
        .btnContactSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WebRocket</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a  class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</nav>
<div class="container contact-form">
    <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <ul>

    </ul>
    <form method="post" action="{{route('offers.store')}}" enctype="multipart/form-data">
        @csrf
        <h3>{{__("offers.head")}}</h3>
        @if(Session::has("success"))
        <div class="alert alert-success" role="alert">
            {{Session::get("success")}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="file" name="image" class="form-control"  />
                </div>

                @error("image")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror

                <div class="form-group">
                    <input type="text" name="name_en" class="form-control" placeholder="{{__("offers.offreName_en")}} *" value="" />
                </div>

                @error("name_en")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror

                <div class="form-group">
                    <input type="text" name="name_fr" class="form-control" placeholder="{{__("offers.offreName_fr")}} *" value="" />
                </div>

                @error("name_fr")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror

                <div class="form-group">
                    <input type="text" name="price" class="form-control" placeholder="{{__("offers.offrePrice_en")}} *" value="" />
                </div>

                @error("price")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror

                {{-- <div class="form-group">
                    <input type="text" name="details" class="form-control" placeholder="Offer details *" value="" />
                </div>  --}}
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="{{__("offers.SendBtn")}}" />
                </div>


            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="details_en" class="form-control" placeholder="{{__("offers.offreDetails_en")}} *"
                              style="width: 100%; height: 150px;"></textarea>
                </div>
                @error("details_en")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror

                <div class="form-group">
                    <textarea name="details_fr" class="form-control" placeholder="{{__("offers.offreDetails_fr")}} *"
                              style="width: 100%; height: 150px;"></textarea>
                </div>
                @error("details_fr")
                <div class="alert alert-danger" role="alert">
                    {{__($message)}}
                </div>
                @enderror
            </div>




        </div>
    </form>
</div>
</body>
</html>








