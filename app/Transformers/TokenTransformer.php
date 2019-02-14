<?php
namespace API\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class TokenTransformer.
 *
 * @package API\Transformers
 *
 * @author Rami Badran <ramibadran_82@gmail.com>
 */

class TokenTransformer extends TransformerAbstract{
    
    public function transform($data){
        
        return [
            'access_token' => $data['token'],
            'token_type'   => 'Bearer',
        ];
    }
}