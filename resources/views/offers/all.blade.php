<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>All Offers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="colorlib.com" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
@if(Session::has("error"))
    <div class="alert alert-danger" role="alert">
        {{Session::get("error")}}
    </div>
@endif
@if(Session::has("success"))
    <div class="alert alert-success" role="alert">
        {{Session::get("success")}}
    </div>
@endif

<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
    <tr>
        <th>#</th>
        <th>{{__("offers.OfferName")}}</th>
        <th>{{__("offers.OfferPrice")}}</th>
        <th>{{__("offers.OfferDetails")}}</th>
        <th>{{__("offers.Operetions")}}</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
 @foreach($offers as $offer)
            <tr>
                <td>{{$offer -> id}}</td>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td >{{$offer -> details}}</td>

                <td>
                    <a href="{{route('offers.edit',$offer -> id)}}" class="btn alert-primary btn-rounded">
                        {{__("offers.edit")}}
                    </a>
                    <a href="{{route('offers.destroy',$offer -> id)}}" class="btn alert-danger btn-rounded">
                        {{__("offers.destroy")}}
                    </a>
                </td>
                <td>
                    <img width="100px" height="100px"  src="{{asset('images/offers/'.$offer->image)}}">
                </td>
            </tr>
 @endforeach
    </tbody>
</table>

</body>
</html>








