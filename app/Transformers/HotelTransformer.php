<?php

namespace API\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class TokenTransformer.
 *
 * @package API\HotelTransformer
 *
 * @author Rami Badran <ramibadran_82@gmail.com>
 */


class HotelTransformer extends TransformerAbstract{
    
    public function transform($data){
        return $data;
    }
}