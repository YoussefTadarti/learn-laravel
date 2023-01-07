@extends('layouts.app')
@section('content')
    <div id="deleted" class="alert alert-success d-none">
        Data deleted
    </div>

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
            <tr class="offerRow{{$offer -> id}}">
                <td>{{$offer -> id}}</td>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td >{{$offer -> details}}</td>
                <td>
                    <a href="{{route('ajax-offers.edit',$offer -> id)}}" class="btn alert-primary btn-rounded">
                        {{__("offers.edit")}}
                    </a>
                    <a href="" offer_id="{{$offer -> id}}" class="offer_id btn alert-danger btn-rounded">
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
@stop

@section('scripts')

    <script>
        $(document).on('click', '.offer_id', function (e) {
            e.preventDefault();
            var offer_id =  $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{route('ajax-offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id
                },
                success: function (response) {
                    if(response.status === true){

                        $('.offerRow'+response.id).remove();
                        document.querySelector('#deleted').classList.add('d-block');

                    }
                },
                error: function (reject) {

                }
            });
        });




    </script>
@stop









