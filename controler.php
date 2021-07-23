
<?php

    class logManager{ // before everything, please ensure yourself to create the "your db name".data file
        
        //second point, every function you are going to build based on database request must be like : function function_namr($arg1,$arg2,argN,&$log,&$response)
        
        //

      private $server="";
      private $DBuser="";
      private $DBpass="";
      private $DBname="";
      public $servResponse=array(
        "status"=>0,
        "response"=>""
      );

      public function __construct($dbname){
        $this->DBname=$dbname;
      }

      public function accessLayer(&servResponse){

        $dbname=$this->DBname;
        $dataHost=array();

        $filler=0;

        if(!file_exists($dbname."data")){
          $this->servResponse=array(
            "status"=>403,
            "response"=>"The databse you are looking for do not exist"
          );
        }
        else{
          $file=fopen($dbname."data","r");

            //here you read all credentials

            while(!feof($file)){
              $dataHost[$filler]=fgets($file);
              $filler++;
            }

          fclose($file);

          $this->server=$dataHost[0];
          $this->DBuser=$dataHost[1];
          $this->DBpass=$dataHost[2];

          $this->servResponse=array(
            "status"=>200,
            "response"=>"Database file founded"
          );

        }
          
         $servResponse=$this->servResponse;

      }

      public function loginServ(&$log,$servResponse){

        $log=new mysqli($this->server,$this->DBuser,$this->DBpass,$this->DBname);

          if($log->connect_error){
            $this->$servResponse=array(
              "status"=>403,
              "response"=>$log->connect_error
            );
          }

          else{
            $this->$servResponse=array(
              "status"=>200,
              "response"=>"Connected"
            );
          }

          $servResponse=$this->servResponse;

      }

      public function logoutServe(&$log){
        $log->close();
      }

      /*public function anything(){

        //instructions and you can add everything you need to use

      }
      */
    }

    }

?>
