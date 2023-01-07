<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Traits\Offers\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AjaxOfferController extends Controller
{
    use OfferTrait;
    public function index(){
        $offers =  Offer::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details','image')->get();
        return view('ajax-offers.index',compact('offers'));
    }
    public function create(){
        // view to add this offer
        return view('ajax-offers.create');
    }


    public function store(offerRequest $request){
        // insert data into db using ajax
        $imgName =$this->saveImage('images/offers',$request -> image);
        $offer = Offer::create([
            'image' => $imgName,
            'name_en'=>$request -> name_en,
            'price'=>$request -> price,
            'details_en' =>$request -> details_en,
            'name_fr'=>$request -> name_fr,
            'details_fr' =>$request -> details_fr,
        ]);
     if($offer)
         return response()->json([
             'success'=>true,
             'msg'=> "{{__('offers.success')}}",
         ]);
     else
         return response()->json([
                'success'=>false,
                'msg'=> "__('Data not found')",
            ]);
    }
    public function delete(offerRequest $request){

        $offer = Offer::find($request -> id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return response()->json([
            'status' => true,
            'id' =>  $request -> id
        ]);

    }

    public function edit($offer_id)
    {
        $offer = Offer::find($offer_id);  // search in given table id only

   if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        $offer = Offer::select('id', 'name_fr', 'name_en', 'details_fr', 'details_en', 'price')->find($offer_id);

        return view('ajax-offers.edit', compact('offer'));

    }

    public  function update(offerRequest $request){

        $offer = Offer::find($request -> offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'Cant find this offer',
            ]);

        //update data
        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'تم  التحديث بنجاح',
        ]);
    }
}
