<!-- Spremanje nove aukcije u bazu podataka -->
<?php

        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        
        if (isset($_SESSION) === false) 
            session_start();
        
        $st = $db->query("SELECT MAX(code) FROM products" );
        $num = $st->fetch();
        $newcode = $num[0] + 1;
        
        //nove slike spremamo u direktoriju uploads
		$target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        // Provjera je li korisnik uistinu uploadao sliku
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file_img"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        if (file_exists($target_file)) {
            echo "File already exists.";
            $uploadOk = 0;
        }
        
        if ($_FILES["file_img"]["size"] > 500000) {
            echo "File is too large.";
            $uploadOk = 0;
        }
        // Dozvoljavamo samo sljedece formate slika
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "File was not uploaded.";
        //Pokusavamo uploadat file
        } else {
            if (move_uploaded_file($_FILES["file_img"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["file_img"]["name"]). " has been uploaded.";
            } else {
                echo "Error uploading your file.";
            }
        }
		$filepath = $target_file;
        
        $db->exec("INSERT INTO products (code, category, title, description, seller, startingPrice,sellNow, imgPath) VALUES ("
                                                          ."'".$newcode ."'".","
                                                          ."'".$_POST['categoryInput']."'".","
                                                          ."'".$_POST['titleInput'] ."'".","
                                                          ."'".$_POST['descriptionInput'] ."'".","
                                                          ."'".$_SESSION['username']."'".","
                                                          ."'".$_POST['startingpriceInput']."'".","
                                                          ."'".$_POST['sellnowInput'] ."'".","
                                                          ."'".$filepath."'".")" );
        $st = $db->query("SELECT MAX(code) FROM auctions" );
        $num = $st->fetch();
        $newcodeauctions = $num[0] + 1;
        $active = "1";
        $db->exec("INSERT INTO auctions (code, product, currentPrice, currentBuyer, active) VALUES ("
                                                          ."'".$newcodeauctions ."'".","
                                                          ."'".$newcode ."'".","
                                                          ."'".$_POST['startingpriceInput'] ."'".","
                                                          ."'".$_SESSION['username'] ."'".","
                                                          ."'".$active ."'".")" );
        
    header("Location: index.php");
        
?>