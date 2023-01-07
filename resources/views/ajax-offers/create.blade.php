@extends('layouts.app')
@section('content')
    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
        </div>
       <div id="inserted" class="alert alert-success d-none">
           Data inserted
       </div>
        <div id="not-inserted" class="alert alert-danger d-none">
            Data not inserted
        </div>
        <form id="offerForm" method="post" action="">
            @csrf
            <h3>{{__("offers.head")}}</h3>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="image" type="file" name="image" class="form-control"  />
                    </div>

                    <div class="form-group">
                        <input id="name_en" type="text" name="name_en" class="form-control" placeholder="{{__("offers.offreName_en")}} *" value="" />
                    </div>

                    <div id="name_en_error" class="form-text text-danger" role="alert">

                    </div>


                    <div class="form-group">
                        <input id="name_fr" type="text" name="name_fr" class="form-control" placeholder="{{__("offers.offreName_fr")}} *" value="" />
                    </div>


                    <div id="name_fr_error" class="form-text text-danger" role="alert">

                    </div>


                    <div class="form-group">
                        <input id="price" type="text" name="price" class="form-control" placeholder="{{__("offers.offrePrice_en")}} *" value="" />
                    </div>


                    <div id="price_error" class="form-text text-danger" role="alert">

                    </div>

                    <div class="form-group">
                        <input id="btnContact" type="submit" name="btnSubmit" class="btnContact" value="{{__("offers.SendBtn")}}" />
                    </div>


                </div>


                <div class="col-md-6">
                    <div class="form-group">
                    <textarea id="details_en" name="details_en" class="form-control" placeholder="{{__("offers.offreDetails_en")}} *"
                              style="width: 100%; height: 150px;"></textarea>
                    </div>

                    <div id="details_en_error" class="form-text text-danger" role="alert">

                    </div>


                    <div class="form-group">
                    <textarea id="details_fr" name="details_fr" class="form-control" placeholder="{{__("offers.offreDetails_fr")}} *"
                              style="width: 100%; height: 150px;"></textarea>
                    </div>
                    <div id="details_fr_error"  class="form-text text-danger" role="alert"></div>
                </div>




            </div>
        </form>
    </div>
@stop

@section('scripts')

<script>

   let  btnContact = document.querySelector('#btnContact');



     btnContact.addEventListener('click',(e)=>{
         e.preventDefault();


         var formData = new FormData($('#offerForm')[0]);
         $('#name_fr_error').text(" ");
         $('#name_en_error').text(" ");
         $('#details_fr_error').text(" ");
         $('#details_en_error').text(" ");
         $('#price_error').text(" ");
             $.ajax({
                 method: 'POST',
                 url: "{{route('ajax-offers.store')}}",
               data: formData,
               enctype : 'multipart/form-data',
                 processData: false,
                 contentType: false,
                 cache: false,
               success: function (response) {
           if(response.success === true)
               document.querySelector('#inserted').classList.add('d-block')

                   if(response.success === false)
                       document.querySelector('#not-inserted').classList.add('d-block')
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
