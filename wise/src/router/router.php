<?php

namespace wise\src\router;

class Router {

    public function  create_multi_handler(){
        return curl_multi_init();
    }

    public function prepare_curl_handles($servers, $fields, $token){
            
        $handles= array();
        foreach($servers as $server_url){
            $handles[$server_url] = $this->prepare_curl_handle($server_url, $fields, $token);
        }
        
        return $handles;
    }

    public function prepare_curl_handle($server_url, $fields ,$token){

        $handle = curl_init($server_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 20);
        curl_setopt($handle, CURLOPT_URL, $server_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, array(
            "token" => $token,
            "fields" => json_encode($fields)
            )
        );
        
        $len = strlen(json_encode($fields)) + strlen(json_encode($token));
        curl_setopt($handle, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type' => 'application/json',
            'Content-Length' => $len
            )
        );

        return $handle;
    }

    public function add_handles($curl_multi_handler, $handles){
        foreach($handles as $handle)
            curl_multi_add_handle($curl_multi_handler, $handle);
    }

    public function perform_multiexec($curl_multi_handler){

        do {
            $mrc = curl_multi_exec($curl_multi_handler, $active);
        } while ($active > 0);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($curl_multi_handler) != -1) {
                do {
                    $mrc = curl_multi_exec($curl_multi_handler, $active);
                } while ($active > 0);
            }
        }
    }

    public function perform_curl_close($curl_multi_handler, $handles){
        
                // is this necessary
        foreach($handles as $handle){
            curl_multi_remove_handle($curl_multi_handler, $handle);
        }
        
        curl_multi_close($curl_multi_handler);
    }

    public function execute_multiple_curl_handles($handles){
        
        $curl_multi_handler = $this->create_multi_handler();
        $this->add_handles($curl_multi_handler, $handles);
        $this->perform_multiexec($curl_multi_handler);
        $this->perform_curl_close($curl_multi_handler, $handles);
    }


    public function trace($var){
        
        echo '<pre>';
        print_r($var);
    }

    public function get_servers($request){
        return $request['servers'];
    }

    public function get_postfields($request){
        foreach($request as $kk=>$vv){
            if($kk!='servers'){
                $fields[$kk]=$vv;
            }
        }
        return $fields;
    }
    public function validate_request($request){
        
        return true;
    }
}
