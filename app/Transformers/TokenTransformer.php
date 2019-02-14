<?php

namespace API\Transformers;

use League\Fractal\TransformerAbstract;



class TokenTransformer extends TransformerAbstract{
    
    public function transform($data){
        
        return [
            'access_token' => $data['token'],
            'token_type'   => 'bearer',
        ];
    }
}