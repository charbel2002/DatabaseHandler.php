<?php

    require("path/to/controller.php");

    //we initialize some variables

    $log = null;
    $response = null;

    $statement = "";

    //You can add your own necessary variables

    //here we make a simple implementation of the logManager class

    $call = new logManager("credentials");//add your own dbname here instead of credential, mine is credentials

    $call->accessLayer($response);//You need to call this function first, otherwise the controler will throw error

    if($response["status"] == 200){

      $call->loginServ($log,$response);

        //you can now try using an additionnal function you've been added to the controler
        
        //Assume it's : $call->register($log,$statement)

      $call->logoutServe($log);

    }
    else{
      echo $response["response"];
    }

?>
