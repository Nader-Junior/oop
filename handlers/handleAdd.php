<?php

require_once '../inc/conn.php';
require_once '../classes/request.php';
require_once '../classes/session.php';
require_once '../classes/validation.php';

use Root\nader\exam\Request;

use Root\nader\required\Session;
use Root\nader\required\Validation;

$request= new Request;
$session = new Session;
$validation = new Validation;


if($request->check($request->post('submit'))){
    
$name = $request->clean($request->post('name'));
$price = $request->clean($request->post('price'));
$description = $request->clean($request->post('description'));
$imageSrc=$_FILES['file']["name"];
$image="images/".$_FILES['file']["name"];

$validation->lastValidate("name",$name,["Required","Str"]);
$validation->lastValidate("description", $description, ["required", "str"]);
$validation->lastValidate("price", $price,["required"]);
$validation->lastValidate("image", $imageSrc,["required"]);

$errors =$validation->getError();
if(empty($errors)){

   $result= $conn->prepare("insert into product(`name`,`price`,`description`,`image`) values (:name,:price,:description,:image)");
   $result->bindParam(":name", $name);
   $result->bindParam(":price", $price);
   $result->bindParam(":description", $description);
   $result->bindParam(":image", $image);

    $result->execute();
    if($result){
        $session->set("success","Data inserted successfully");
        $request->redirect("../index.php");
    }else{
        $session->set("errors",["Error while insert"]);
        $request->redirect("../index.php");
    }
}else{
    $session->set("error", $errors);
    $error =$session->get("error");
    foreach ($error as $key ) {
        echo $key."<br>";
    }
}

}else{
    $request->redirect("../index.php");
}

