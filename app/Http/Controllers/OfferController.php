<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Traits\Offers\OfferTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\Console\Input\Input;

class OfferController extends Controller
{
    use OfferTrait;
    public function index(){
        $offers =  Offer::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details','image')->get();
        return view('offers.all',compact('offers'));
    }
    public function create(){
        return view('offers.offer');
    }
    public function store(offerRequest $request){
        /*$rules = $this -> getRules();
        $errorsMsg = $this -> getMessages();
        $request->validate($rules,$errorsMsg);*/
        //save image in folder
        $imgName =$this->saveImage('images/offers',$request -> image);
        Offer::create([
            'image' => $imgName,
            'name_en'=>$request -> name_en,
            'price'=>$request -> price,
            'details_en' =>$request -> details_en,
            'name_fr'=>$request -> name_fr,
            'details_fr' =>$request -> details_fr,
        ]);
        return back()->with(["success"=>__('offers.success')]);
    }
    public function edit($id){
       $offer_id =  Offer::findOrFail($id);
        $offer =  Offer::select('id',
            'name_fr','name_en',
            'price',
            'details_fr','details_en')
            ->find($offer_id);

       return view('offers.edit',compact('offer'));
    }
    public function update(offerRequest $request,$id){
       //validation

        //update
        $offer_id =  Offer::findOrFail($id);
        $offer_id->update(
            $request->all()
        );
        return redirect()->back()->with(['success'=>"Data updeted"]);
    }
    public function destroy($id){
        $offer_id = Offer::find($id);
        if(!$offer_id)
            return redirect()->route('offers.index')->with(['error'=>__('Data not found')]);
        $offer_id -> delete();
        return redirect()->route('offers.index')->with(['success'=>__("Data deleted")]);
    }

}
