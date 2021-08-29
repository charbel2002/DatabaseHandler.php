
<?php

    class logManager{ // before everything, please ensure yourself to create the "your db name".data file
        
        //second point, every function you are going to build based on database request must be like : function function_namr($arg1,$arg2,argN,&$log,&$response)
        
        //

      
        //second point, every function you are going to build based on database request must be like : function function_namr($arg1,$arg2,argN,&$log,&$response)

        //

      private $server="";
      private $DBuser="";
      private $DBpass="";
      private $DBname="";
        
      public $servResponse=array(
        "status"=>0,
        "response"=>null
      );

      public function __construct($dbname){
        $this->DBname=$dbname;
      }

      public function varHandler($local_statement,&$target_statement){

        $target_statement = $local_statement;

      }

      public function accessLayer(&$servResponse){

        $dbname=$this->DBname;
        $dataHost=array();

        $filler=0;

        if(file_exists($dbname.".data")){
          $file=fopen($dbname.".data","r");

            //here you read all credentials

            while(!feof($file)){
              $dataHost[$filler]=fgets($file);
              $filler++;
            }

          fclose($file);

          $this->server=rtrim($dataHost[0],"\r\n");
          $this->DBuser=rtrim($dataHost[1],"\r\n");
          $this->DBpass=rtrim($dataHost[2],"\r\n");

          $this->servResponse=array(
            "status"=>200,
            "response"=>"Database file founded"
          );

        }
        else{
          $this->servResponse=array(
            "status"=>403,
            "response"=>"The databse you are looking for do not exist"
          );

        }

         $servResponse=$this->servResponse;

      }

      public function loginServ(&$log,$servResponse){

        $log=new mysqli($this->server,$this->DBuser,$this->DBpass,$this->DBname);

          if($log->connect_error){
            $this->servResponse=array(
              "status"=>403,
              "response"=>$log->connect_error
            );
          }

          else{
            $this->servResponse=array(
              "status"=>200,
              "response"=>"Connected"
            );
          }

          $servResponse=$this->servResponse;

      }

      public function logoutServe(&$log){
        $log->close();
      }
    

    }

?>
