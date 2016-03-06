<?php

require_once '../../codelab/helper_functions.php';
require_once '../../includes/config.php';
require_once '../../vendor/autoload.php';
//instantiate database connection
$DB = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
$structure = new NotORM_Structure_Convention(
    $primary = "%s_Id", // $table_Id
    $foreign = "%s_Id", // $table_Id
    $table = "%s" // {$table}
    
);
$db = new NotORM($DB,$structure);
require_once plugin_dir_path((dirname(dirname(__FILE__)))) . "codelab" . DS . 'autoload.php';

//$member = $db->member()->select("first_name","last_name")->where(array("first_name" => 'tosin'));
////var_dump($member);
//foreach ($member as $this_member) {
//    echo $this_member['first_name']; 
//    echo $this_member['last_name']; 
//}




$app = new \Slim\App;

$app->get('/member', function (\Psr\Http\Message\ServerRequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response) {
  
    $member = new Member();
    $result_container = array();
   $result =  $member->_get();
   foreach($result as $this_result){
       $result_container[] = $this_result;
   }
    return json_encode($result_container);
});

$app->get('/member/{member_Id}', function ( 
\Psr\Http\Message\ServerRequestInterface $request
, \Psr\Http\Message\ResponseInterface $response,$args) {
   $member_Id = $args['member_Id'];
   
   $data = array('member_Id'=>$member_Id);
   $member_object = new Member();
    $response = json_encode($member_object->_get($data));
    return $response;
});

$app->post('/member', function (\Psr\Http\Message\ServerRequestInterface $request, 
        \Psr\Http\Message\ResponseInterface $response) {
   $parsedBody = $request->getParsedBody();
    $member = new Member();
   
    $response = $member->_create($parsedBody['member']);
     if($response){
         $response = array("status" => true,"message"=>"success","data"=>null);
          
     }else{
         $response = array("status" => false,"message"=>"Error occured","data"=>null);
        
     }
    return json_encode($response);
});

$app->put('/member/{member_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
    $member_Id = $args['member_Id'];
    $member = new Member();
    $parsedBody = $request->getParsedBody();
    $member_object = $parsedBody["member"];
    
    if(array_key_exists('reqParams',$member_object)){
        unset($member_object['reqParams']);
    };
    if(array_key_exists('restangularized',$member_object)){
        unset($member_object['restangularized']);
    };
    if(array_key_exists('fromServer',$member_object)){
        unset($member_object['fromServer']);
    }
   if(array_key_exists('parentResource',$member_object)){
        unset($member_object['parentResource']);
    }
     if(array_key_exists('restangularCollection',$member_object)){
        unset($member_object['restangularCollection']);
    }
    if(array_key_exists('route',$member_object)){
        unset($member_object['route']);
    }
    
    $meta = $parsedBody["meta"];
    if($meta['updatePic'] != 0){
        @unlink("../../../images/".$meta['old_pic']);
    };
     $response = $member->_update($member_Id,$member_object);
      if($response){
         $response = array("status" => true,"message"=>"success","data"=>null);
          
     }else{
         $response = array("status" => false,"message"=>"Error occured","data"=>null);
        
     }
    return json_encode($response);
});
$app->delete('/member/{member_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
   $member_Id = $args['member_Id'];
   $member = new Member(); 
    $response = $member->_delete($member_Id);
  if($response){
         $response = array("status" => true,"message"=>"success","data"=>null);
          
     }else{
         $response = array("status" => false,"message"=>"Error occured","data"=>null);
        
     }
    return json_encode($response);
});

$app->get('/careerRecord', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response) {
   
  

    return $response;
});
$app->get('/careerRecord/member/{member_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
   
    $member_Id = $args['member_Id'];
     
   $career = new Career();
   $result =  $career->_get(array("member_Id = ?", $member_Id));
   $member = new Member();
   $member_details = $member->_get(array("member_Id = ?", $member_Id),
                    array("first_name","last_name","passport"));
   
   $member_container = array();
   if($member_details){
        foreach($member_details as $this_detail){
       $member_container[] = $this_detail;
   }
   }
     if($result){
         $result_container = array();
       foreach($result as $this_result){
       $result_container[] = $this_result;
   }
   
    $response = array("status" => true,"message"=>"Success","data"=>array('career'=>$result_container,'member'=>$member_container));
   }else{
      $response = array("status" => false,"message"=>"Error occured","data"=>$result);
   }
    return json_encode($response);
});
$app->post('/careerRecord', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response) {
 $parsedBody = $request->getParsedBody();
    $career = new Career();
    
    $response = $career->_create($parsedBody['career']);
    
     if($response){
         $response = array("status" => true,"message"=>"success","data"=>null);
          
     }else{
         $response = array("status" => false,"message"=>"Error occured","data"=>null);
        
     }
    return json_encode($response);
});
$app->put('/careerRecord/{career_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
   $career_Id = $args['career_Id'];
   $parsedBody = $request->getParsedBody(); 
   return $response;
});



$app->delete('/careerRecord/{career_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
    $career_Id = $args['career_Id'];

    return $response;
});

$app->get('/financialRecord', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response) {
    return $response;
});
$app->get('/financialRecord/member/{member_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
   $member_Id = $args['member_Id'];
   $transaction = new Transaction();
   $result = $transaction->_get(array("member_Id = ?", $member_Id));
   $member = new Member();
   $member_details = $member->_get(array("member_Id = ?", $member_Id),
                    array("first_name","last_name","passport"));
   $member_container = array();
   if($member_details){
        foreach($member_details as $this_detail){
       $member_container[] = $this_detail;
   }
   }
   
   if($result){
         $result_container = array();
       foreach($result as $this_result){
       $result_container[] = $this_result;
   }
   
    $response = array("status" => true,"message"=>"success","data"=> 
                array('account'=>$result_container,'member'=>$member_container)
                  );
   }else{
      $response = array("status" => false,"message"=>"Error occured","data"=>$result);
   }
    return json_encode($response);
});

$app->post('/financialRecord', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response) {
   $parsedBody = $request->getParsedBody();
    $transaction = new Transaction();
    
    $response = $transaction->_create($parsedBody['transaction']);
    
     if($response){
         $response = array("status" => true,"message"=>"success","data"=>null);
          
     }else{
         $response = array("status" => false,"message"=>"Error occured","data"=>null);
        
     }
    return json_encode($response);
});

$app->put('/financialRecord/{record_Id}', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response,$args) {
   
  $record_Id = $args['record_Id'];
  $parsedBody = $request->getParsedBody();

    return $response;
});
$app->run();