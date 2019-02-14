<?php
namespace API\Builders;

use API\Builders\BestHotelCaller;
use API\Builders\CrazyHotelCaller;
use Config;

/**
 * Class Builders.
 *
 * @package API\Builder
 *
 * @author Rami Badran <ramibadran_82@gmail.com>
 */

class Builder{
    public function builder($case,$api,$param,$method='GET'){
        switch ($case) {
            case "bestHotel":
                $bestHotel = new BestHotelCaller();
                $query     = $this->buildBestQuery($param);               
                $result    = $bestHotel->bestHotelCaller($api,$query,$method);
                break;
            case "crazyHotel":
                $crazyHotel = new CrazyHotelCaller();
                $query      = $this->buildCrazyQuery($param);
                $result     = $crazyHotel->crazyHotelCaller($api,$query,$method);
                break;
        }
        return $result;
    }
    
    private function buildBestQuery($param){
        $data = array(
                    'city'           => strtoupper($param['city']),
                    'fromDate'       => $param['fromDate'],
                    'toDate'         => $param['toDate'],
                    'numberOfAdults' => $param['numberOfAdults']
                );
        return http_build_query($data);        
    }
    
    private function buildCrazyQuery($param){
        $data = array(
                    'city'        => strtoupper($param['city']),
                    'from'        => urlencode($this->isoDate($param['fromDate'])),
                    'To'          => urlencode($this->isoDate($param['toDate'])),
                    'adultsCount' => $param['numberOfAdults']
                );
        return http_build_query($data);        
    }
    
    private function isoDate($date,$format = 'Y-m-d\TH:i:s\Z'){
        return date($format, strtotime($date));
    }
}