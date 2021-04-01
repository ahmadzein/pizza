<?
include_once '../modules/helpers.php';

$post = file_get_contents('php://input');

$JData= json_decode($post,true);
    $JData["role_id"] = 3;
$user_status = 1;
$post = json_encode($JData);
$url ="/api/user/add.php";

$qu= postSamePHP($url,$post);

if($qu["result"]){

    $uid =$qu["id"];
    $usData=  '{"user_id":"'.$uid.'","status_id": '.$user_status.'}';
    $post = $usData;
    $url ="/api/user/addstatus.php";
    $qs= postSamePHP($url,$post);
  if($qs["result"]){
   
    
    $JData["user_id"] = $uid;
$post = json_encode($JData);
$url ="/api/address/add.php";
$qa= postSamePHP($url,$post);
if($qa["result"]){
   

$aid=$qa["id"] ;
   $uaData=  '{"user_id":"'.$uid.'","address_id":"'. $aid.'"}';
    
    $post = $uaData;
$url ="/api/address/addprime.php";
$qa= postSamePHP($url,$post);
    $user_status =2;
$usData=  '{"user_id":"'.$uid.'","status_id": '.$user_status.'}';
        $post = $usData;
$url ="/api/user/addstatus.php";
$qs= postSamePHP($url,$post);
    
     if($qa["result"] && $qs["result"]){
         session_start();

    $_SESSION["user"]["id"] =$uid;
    $_SESSION["user"]["f_name"] =$JData["f_name"];
    $_SESSION["user"]["l_name"] =$JData["l_name"];
    $_SESSION["user"]["role"] =$JData["role_id"];
    $_SESSION["user"]["postalcode"] =$JData["postalcode"];
    $_SESSION["user"]["status_id"] =$user_status;

        echo true; 
        
     }else{
         echo false;
     }
}else{
    echo false;
}
  }

}else{
    echo $qu["message"]; 
}





?>