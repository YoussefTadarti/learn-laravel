<?php
namespace app\Traits\Offers;
trait OfferTrait {
    protected function saveImage($path,$img){
        $img_extension = $img -> getClientOriginalExtension();
        $imgName = time().".".$img_extension;
        $img -> move($path ,$imgName);

        return $imgName;
    }
}
