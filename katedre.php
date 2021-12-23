<?php
    include "broker.php";
    $broker=Broker::getBroker();
     if(isset($_POST["akcija"])){
        if($_POST["akcija"]=="obrisi"){
            $broker->obrisiKatedru($_POST["id"]);
            if(!$broker->getRezultat()){
                echo $broker->getMysqli()->error;
            }else{
                echo "ok";
            }
            
        }else{
            $naziv=$_POST["naziv"];
            $opis=$_POST["opis"];
            $sef=$_POST["sef"];
            if(!validnaKatedra($naziv,$opis,$sef)){
                echo "losi podaci";
                return;
            }else{
                if($_POST["akcija"]=="izmeni"){
                    $broker->izmeniKatedru($_POST["id"],$naziv,$opis,$sef);
                }else{
                    $broker->dodajKatedru($naziv,$opis,$sef);
                }
                
            }
            if(!$broker->getRezultat()){
                echo $broker->getMysqli()->error;
            }
            echo "ok";
        }
    }
    function validnaKatedra($naziv,$opis,$sef){
        $naziv=trim($naziv);
        $opis=trim($opis);
        $sef=trim($sef);
        return strlen($naziv)>=5 && strlen($opis)<=100  && preg_match("/^[A-Z][A-Za-z\s]*$/",$naziv);
    }


?>