<?php


namespace App\Traits;


Trait MondiapayServices
{
    use ConsumesExternalService;

    protected $baseUri;
    protected $mondia_client_id;
    protected $mondia_secret;
    protected $mondia_subscription_type_id;

    public function __construct()
    {
        $this->baseUri = config("mondiapay_service.base_url");
        $this->mondia_client_id = config("mondiapay_service.client_id");
        $this->mondia_secret = config("mondiapay_service.client_secret");
        $this->mondia_subscription_type_id = config("mondiapay_service.subscription_type_id");
    }

    public function GetAccessToken(){

        $header = [
            "accept" => "application/json",
            "content-type" => "application/x-www-form-urlencoded"
        ];

        try {
            $url = "/v1/api/oauth/token?grant_type=client_credentials&client_id={$this->mondia_client_id}&client_secret={$this->mondia_secret}";
            $response = json_decode($this->performMondiaPayRequest("POST",$url,[],$header));
            $response->code = 200;
        }catch (\Exception $e){

            $object = new \stdClass();
            $object->code = 401;
            $object->message = "unauthorised";

            return $object;
        }

        return $response;
    }


    public function GetAccessTokenWithUUID($uuid){

        $header = [
            "accept" => "application/json",
            "content-type" => "application/x-www-form-urlencoded"
        ];

        try {
            $url = "/v1/api/oauth/token?grant_type=user_credentials&client_id={$this->mondia_client_id}&client_secret={$this->mondia_secret}&uuid={$uuid}";
            $response = json_decode($this->performMondiaPayRequest("POST",$url,[],$header));
            $response->code = 200;
        }catch (\Exception $e){
            $object = new \stdClass();
            $object->code = 401;
            $object->message = "unauthorised";

            return $object;
        }

        return $response;
    }
}
