<?php

class ApiResponse { 



static $dataRetrievedSuccessfully = "Data Retrieved Successfully";
static $dataRetrievedFailed = "Data Retrieved Failed"; 

static function successfullCreatedMeassage($text) {
  return  " $text Successfully created";
} 


static function failedCreatedMeassage($text) {
 return  " Failed to create $text";
} 
    
public static function apiResponse($status = 201, $message = null, $data =[]){

 $response = [
     'status'=>$status,
     'message'=>$message,
     'data'=>$data
 ];
     return response()->json($response, $status);
}
}




?>