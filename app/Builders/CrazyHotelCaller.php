<?php
namespace API\Builders;

/**
 * Class CrazyHotelCaller.
 *
 * @package API\Builders
 *
 * @author Rami Badran <ramibadran_82@gmail.com>
 */

final class CrazyHotelCaller extends RestCaller{
    
    public function crazyHotelCaller($url,$query,$method){
        return $this->handlingResponse($this->callRest($url,$query,$method));
    }
    
    private function handlingResponse($data){
        $responsData = array();
        foreach($data as $value){
            foreach($value as $result){
                array_push($responsData,[
                    'provider'  => 'crazy-hotel',
                    'hotelName' => $result['hotelName'],
                    'rate'      => $this->convertStarsToNumber($result['rate']),
                    'fare'      => $result['price'],
                    'amenities' => $this->handelAmenities($result['amenities']),                  
                ]);
            }
        }
        return $responsData;
    }
    
    private function convertStarsToNumber($stars){
        return substr_count($stars,'*');
    }
    
    private function handelAmenities($string){
        return explode(',', $string);
    }
}