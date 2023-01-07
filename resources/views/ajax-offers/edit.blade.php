@extends('layouts.app')
@section('content')
    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
        </div>


        <form method="post" id="offerFormUpdate" action="">
            @csrf
            <h3>{{__("offers.headEdit")}}</h3>
            <div id="success_msg" class="alert alert-success d-none">
                Data edited
            </div>
            <input type="text" style="display: none;" class="form-control" value="{{$offer->id}}" name="offer_id">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name_en" class="form-control" value="{{$offer->name_en}}"/>
                    </div>

                    <div id="name_en_error" class="form-text text-danger" role="alert">

                    </div>

                    <div class="form-group">
                        <input type="text" name="name_fr" class="form-control" value="{{$offer->name_fr}}" />
                    </div>

                    <div id="name_fr_error" class="form-text text-danger" role="alert">

                    </div>

                    <div class="form-group">
                        <input type="text" name="price" class="form-control" value="{{$offer->price}}" />
                    </div>

                    <div id="price_error" class="form-text text-danger" role="alert">

                    </div>

                    <div class="form-group">
                        <input type="submit" id="update_offer" name="btnSubmit" class="btnContact" value="{{__("offers.UpdateBtn")}}" />
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="form-group">
                    <textarea name="details_en" class="form-control"
                              style="width: 100%; height: 150px;">{{$offer->details_en}}</textarea>
                    </div>
                    <div id="details_en_error" class="form-text text-danger" role="alert">

                    </div>

                    <div class="form-group">
                    <textarea name="details_fr" class="form-control"
                              style="width: 100%; height: 150px;">{{$offer->details_fr}}</textarea>
                    </div>
                    <div id="details_fr_error" class="form-text text-danger" role="alert">

                    </div>
                </div>




            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $('#name_fr_error').text(" ");
            $('#name_en_error').text(" ");
            $('#details_fr_error').text(" ");
            $('#details_en_error').text(" ");
            $('#price_error').text(" ");
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax-offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        document.querySelector('#success_msg').classList.add('d-block');
                    }
                },
                error: function (reject) {
                    let response = $.parseJSON(reject.responseText);
                    let errors = response.errors;

                    Object.keys(errors).forEach(function (key) {
                        $("#"+key +"_error").text(errors[key]);
                    });
                }
            });
        });
    </script>
@stop
