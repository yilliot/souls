<?php

namespace App\Transformers;

class JobRejectCodeTransformer extends Transformer
{
    
    public function transform($code)
    {
        $field = $code['field'];
        $subfield = null;
        if (substr($code['field'], 0, 5) == 'area.') {
            $field = 'area';
            $subfield = substr($code['field'], 5);
        }
        if (substr($code['field'], 0, 5) == 'photo') {
            $field = 'photo';
            $subfield = substr($code['field'], 5, 1);
        }
        return [
            'field' => $field,
            'subfield' => $subfield,
            'code' => $code['code'],
            'message' => trans('job_reject_codes.'.$field.'.'.$code['code']),
        ];
    }
}