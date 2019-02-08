<!-- Ovdje efektivno mijenjamo linije u tablicama products i auctions -->
<!-- Ako je nas bid veci od prethodno najveceg bida, onda je nova najveca cijena upravo ta nasa -->
<!-- Ako je nas bid veci ili jednak od buy now, onda je proizvod kupljen i nije vise aktivan -->

<?php 
        if (isset($_SESSION) === false) 
                session_start();
        $currentBuyer = $_SESSION['username'];
        
        $code = $_SESSION['code'];
        
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM products WHERE code = '."'".$code."'" );
        $dt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$code."'" );
        $kupisad      = "";
        $starinajvisi = "";
        foreach( $st->fetchAll() as $row ){
             $kupisad = $row[ 'sellNow' ] ;
        }
        foreach( $dt->fetchAll() as $row ){
             $starinajvisi = $row[ 'currentPrice' ] ;
        }
         //slucaj kada se zapravo bidamo
        if(isset($_POST['newBid']))       
            $newbid = $_POST['newBid'];
		//slucaj kada smo odlucili kupiti po "buy now" cijeni		
        else
            $newbid = $kupisad;           
        
        if($newbid > $starinajvisi ) 
            $st = $db->query( "UPDATE auctions SET currentPrice="."'".$newbid."'".", currentBuyer ="."'".$currentBuyer."'"." WHERE product="."'".$code."'");
        
        if($newbid >= $kupisad)
            $st = $db->query( "UPDATE auctions SET currentPrice="."'".$newbid."'".", currentBuyer ="."'".$currentBuyer."'".", "."active = '0'"." WHERE product="."'".$code."'");

        header("Location: index.php");
        ?>