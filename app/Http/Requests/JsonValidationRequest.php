<?php

namespace App\Http\Requests;

use App\Services\ConstantApiMessageService;
use App\Services\ConstantStatusService;
use League\Fractal\Serializer\JsonApiSerializer;

class JsonValidationRequest extends JsonApiSerializer
{

    // protected  $data;

    public function __construct()
    {
    }

    public function validateJsonSpec($data)
    {

        if (empty($data) == true) {
            $message = ConstantApiMessageService::JSONPARSEERROR;
            $error = $this->missingDataAttribute(null,null,null,$message);
            return response()->json($error,ConstantStatusService::BADREQUEST);
        }elseif (empty($data['data'])== true) {
            $message = ConstantApiMessageService::MISSINGJSONDATA;
            $key = '/data';
            $error = $this->missingDataAttribute(null,null,$key,$message);
            return response()->json($error,ConstantStatusService::UNPROCESSABLEENTITY);
        }
        $resource = $data['data'];

        if (!array_key_exists('id', $resource)) {
            $message = ConstantApiMessageService::VALIDJSONID;
            $key = '/data/id';
            $error = $this->missingDataAttribute(null,null,$key,$message);
            return response()->json($error,ConstantStatusService::UNPROCESSABLEENTITY);
        } elseif (!array_key_exists('type', $resource)) {
            $key = '/data/type';
            $message = ConstantApiMessageService::VALIDJSONTYPE;
            $error = $this->missingDataAttribute(null,null,$key,$message);
            return response()->json($error,ConstantStatusService::UNPROCESSABLEENTITY);
        } elseif (!array_key_exists('attributes', $resource)) {
            $key = '/data/attributes';
            $message = ConstantApiMessageService::VALIDJSONATTRIBUTE;
            $error = $this->missingDataAttribute(null,null,$key,$message);
            return response()->json($error,ConstantStatusService::UNPROCESSABLEENTITY);
        } elseif (!array_key_exists('links', $resource)) {
            $key = '/data/links';
            $message = ConstantApiMessageService::VALIDJSONLINK;
            $error = $this->missingDataAttribute(null,null,$key,$message);
            return response()->json($error,ConstantStatusService::UNPROCESSABLEENTITY);
        } else {
            return false;
        }
    }

    public function missingDataAttribute($status,$code,$value,$message)
    {
        $key = 'pointer';

        if (empty($value) == false && empty($code) == false && empty($status) == false) {
            $error['source'] = $key.'":' .'"'. $value;
            $error['code'] = $code;
            $error['status'] = $status;
        }elseif (empty($value) == false && empty($code) == false) {
            $error['source'] = $key.'":' .'"'. $value;
            $error['code'] = $code;
        }elseif (empty($value) == false) {
            $error['source'] = $key .'":'. '"'.$value;
        } elseif (empty($code) == false) {
            $error['code'] = $code;
        } elseif (empty($status) == false) {
            $error['status'] = $status;
        }

        $error['detail'] = $message;
        $jsonApiError['errors'][] = $error;
        return $jsonApiError;
    }


}
