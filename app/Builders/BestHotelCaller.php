<?php
namespace API\Builders;

final class BestHotelCaller extends RestCaller{
    
    public function bestHotelCaller($url,$query,$method){
        return $this->handlingResponse($this->callRest($url,$query,$method));
    }
    
    private function handlingResponse($data){       
        $responsData = array();
        foreach($data as $value){
            foreach($value as $result){
                array_push($responsData,[
                    'provider'  => 'best-hotel',
                    'hotelName' => $result['hotel'],
                    'rate'      => (int)$result['hotelRate'],
                    'fare'      => $result['hotelFare'],
                    'amenities' => $this->handelAmenities($result['roomAmenities']),
                ]);
            }
        }
        return $responsData;
    }
    
    private function handelAmenities($string){
        return explode(',', $string);
    }
    
}