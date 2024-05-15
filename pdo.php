<?php
$host = '66.94.119.136'; // Update as needed
$dbname = 'blockchain'; // Update as needed
$username = 'swix'; // Update as needed
$password = 'maynO/*69'; // Update as needed

session_start(); 
            try{
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
              
              }
            catch(PDOException  $e){
              print "Erreur !: " . $e->getMessage() ;
            } 
      ?>