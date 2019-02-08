<!-- Izmjena podataka korisnika. Nije dozvoljeno mijenjati username te ime i prezime. -->
<?php
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        if (isset($_SESSION) === false) 
            session_start();
        
        $usrname = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        
        if ($_POST['passInput'] != "") 
            $st = $db->query( "UPDATE users SET password="."'".$_POST['passInput']."'"." WHERE username="."'".$usrname."'");
        
        if ($_POST['emailInput'] != "") 
            $st = $db->query( "UPDATE users SET email="."'".$_POST['emailInput']."'"." WHERE username="."'".$usrname."'");
        
        if ($_POST['addrInput'] != "") 
            $st = $db->query( "UPDATE users SET address="."'".$_POST['addrInput']."'"." WHERE username="."'".$usrname."'");
        
        if ($_POST['phoneInput'] != "") 
            $st = $db->query( "UPDATE users SET phone="."'".$_POST['phoneInput']."'"." WHERE username="."'".$usrname."'");

		header("Location: index.php");
?>