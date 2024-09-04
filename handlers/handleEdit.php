<?php

require_once '../classes/request.php';
require_once '../classes/session.php';
require_once '../classes/validation.php';
require_once '../inc/conn.php';


use Root\nader\required\Session;

use Root\nader\exam\Request;
use Root\nader\required\Validation;
$request= new Request;
$validation = new Validation;
$session = new Session;


if ($request->check($request->post('submit')) && $request->check($request->get('id'))) {

    $id = $request->get('id');
    $name = $request->clean($request->post('name'));
    $price = $request->clean($request->post('price'));
    $description = $request->clean($request->post('description'));
    $imageSrc=$_FILES['file']["name"];
    $image="images/".$_FILES['file']["name"];
    $validation->lastValidate("name", $name, ["required", "str"]);
    $validation->lastValidate("description", $description, ["required", "str"]);
    $validation->lastValidate("price", $price,["required"]);
    $validation->lastValidate("image", $imageSrc,["required"]);
    $errors = $validation->geterror();
    if (empty($errors)) {
        $run = $conn->prepare("select * from product where id=:id");
        $run->bindParam(":id",$id);
        $run->execute();
        if ($run->rowCount() == 1) {
            $result1 = $conn->prepare("update product set `name`=:name , `price`=:price , `description`=:description,`image`=:image where id=:id");
            $result1->bindParam(":id", $id);
            $result1->bindParam(":name", $name);
            $result1->bindParam(":price", $price);
            $result1->bindParam(":description", $description);
            $result1->bindParam(":image", $image);
            $result1->execute();
            if ($result1->rowCount() == 1) {
                $request->redirect("../index.php");
            } else {
                $request->redirect("../index.php");
            }
        } else {
            $request->redirect("../index.php");
        }
    }else {
        $session->set("error", $errors);
        $error =$session->get("error");
        foreach ($error as $key ) {
            echo $key."<br>";
        }
        
        
    }
 
} else {
    $request->redirect("../index.php");
}
