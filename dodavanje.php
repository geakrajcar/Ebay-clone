<!-- Dodajemo u tablicu novu kategoriju ili novog usera -->
<?php
		//spajanje na bazu
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        if (isset($_SESSION) === false) 
                session_start();
		//Dodavanje nove kategorije :
        if(isset($_POST['newCategory'])){  
            $st = $db->query( 'SELECT COUNT(*) FROM category WHERE title = '."'".$_POST['newCategory']."'" );
            $num = $st->fetch();
            //Nove slike za kategorije spremamo u direktorij img
            $target_dir = "img/";
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
            //Pokusavamo uploadat file, tj premjestiti ga sa temporary (tmp_name) mjesta na serveru u nas direktorij
            } else {
                if (move_uploaded_file($_FILES["file_img"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["file_img"]["name"]). " has been uploaded.";
                } else {
                    echo "Error uploading your file.";
                }
            }
            $filepath = $target_file;
            
            //Ukoliko kategorija veæ ne postoji, dodajemo ju
            if($num[0]==0){
                $db->exec("INSERT INTO category (title, imgPath) VALUES"."("."'".$_POST['newCategory']."' ,"."'".$filepath."'".")" );
            }
        }
		//Dodavanje novog usera
        if(isset($_POST['userInput'])){    
            $usrname = isset($_POST['userInput']) ? $_POST['userInput'] : '';
            $st = $db->query( 'SELECT COUNT(*) FROM users WHERE username = '."'".$usrname."'" );
            $num = $st->fetch();
            if($num[0]>0)
                    echo "Zauzet username!";
            else{
                $isadmin = 0;
                
                $db->exec("INSERT INTO users (username, password, name, address, phone, email) VALUES ("
                                                          ."'".$_POST['userInput'] ."'".","
                                                          ."'".$_POST['passInput'] ."'".","
                                                          ."'".$_POST['nmsurnm']   ."'".","
                                                          ."'".$_POST['addrInput'] ."'".","
                                                          ."'".$_POST['phoneInput']."'".","
                                                          ."'".$_POST['emailInput']."'".")" );
                                                          

                if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
                    header("Location: index.php");
                else{
                    $_SESSION['username'] = $_POST['userInput'];
                    $_SESSION['admin'] = $isadmin;
                }
            }
        }
        header("Location: index.php");
?>