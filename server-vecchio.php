<?php


// initializing variables
$username = "";
$email    = "";
$nome    = "";
$errors = array();
$tuoitour=array(); 
$isOrganize=false;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'irizzo');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 if(!isset($_SESSION)) {
  $_SESSION['isLogged']=NULL;
     session_start();

}

//ACCETTAZIONE TOUR
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['accetta']))
    {
        accetta();
    }
    //RIFIUTA TOUR
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['rifiuta']))
    {
        rifiuta();
    }
    //ISCRIVITI
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['iscriviti']))
    {
        iscriviti();
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['disiscriviti']))
    {
        disiscriviti();
    }
    
//REGISTRAZIONE DEGLI UTENTI
if (isset($_POST['registrazione_utente'])) {
  // receive all input values from the form
  $nome = mysqli_real_escape_string($db, $_POST['nome']);
  $cognome = mysqli_real_escape_string($db, $_POST['cognome']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['passwordR']);
  if(empty($nome)){
    $errors['nome']="Nome richiesto";
  }
  if(empty($cognome)){
    $errors['cognome']="Cognome richiesto";
  }
  if(empty($username)){
    $errors['username']="Username richiesto";
  }
  if(empty($email)){
    $errors['email']="Email richiesta";
  }
  if(empty($nome)){
    $errors['password']="Password richiesta";
  }
  if(empty($nome)){
    $errors['password2']="Conferma password";
  }
  if($password != $password_2){
    $errors['password']="Le password non corrispondono";
    $errors['password2']="Le password non corrispondono";
  }
  if(strpos($email,'@') == false){
    $errors['email']="Fornire una mail valida";
  }
  
  if(strlen($password)<4){
    $errors['password']="La password deve contenere almeno 4 caratteri";
  }
    else{

        //controllo se esiste già uno username uguale
               $controllo = "SELECT * FROM `utenti` WHERE Username='$username' ";
                $result = mysqli_query($db,$controllo) or die(mysql_error());
              $rows = mysqli_num_rows($result);
              if($rows==1){
                  $errors['esistente']="Username non disponibile";
              }
              elseif($password==$password_2){
                      $query = "INSERT INTO utenti ( nome, cognome, username, email, password, ruolo) 
                      			  VALUES('$nome','$cognome','$username', '$email', '$password', 'User')";
                      	mysqli_query($db, $query);
                        $_SESSION['usernameU']=$username;
                        $_SESSION['isLoggedU']=true;
                        $tipo="utente";
                        $query2 = "INSERT INTO log (username, password, tipo)VALUES('$username','$password', '$tipo')";
                        mysqli_query($db, $query2);
                        //reindirizzamento
                        header("Location: area_riservata_utente.php");
              }else
            $errors['noPassword']="Le password non coincidono";  	
  }
}



//REGISTRAZIONE DELLE AZIENDE
if (isset($_POST['registrazione_azienda'])) {
  echo "1";
  // receive all input values from the form
  $nomeA = mysqli_real_escape_string($db, $_POST['NomeAzienda']);
  $nomeR = mysqli_real_escape_string($db, $_POST['NomeReferente']);
  $emailR = mysqli_real_escape_string($db, $_POST['EmailReferente']);
  $username = mysqli_real_escape_string($db, $_POST['Username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['passwordR']);
  echo "1.5";
  if(empty($nome)){
    $errors['NomeAzienda']="Nome richiesto";
  }
  if(empty($cognome)){
    $errors['NomeReferente']="Cognome richiesto";
  }
  if(empty($username)){
    $errors['EmailReferente']="Email richiesta";
  }
  if(empty($email)){
    $errors['Username']="Username richiesto";
  }
  if(empty($nome)){
    $errors['password']="Password richiesta";
  }
  if(empty($nome)){
    $errors['password2']="Conferma password";
  }
  if($password != $password_2){
    $errors['password']="Le password non corrispondono";
    $errors['password2']="Le password non corrispondono";
  }
  if(strpos($email,'@') == false){
    $errors['EmailReferente']="Fornire una mail valida";
  }
  
  if(strlen($password)<4){
    $errors['password']="La password deve contenere almeno 4 caratteri";
  }
    else{
      echo "2";

        //controllo se esiste già uno username uguale
              $controllo = "SELECT * FROM `aziende` WHERE username='$username' ";
              $result = mysqli_query($db,$controllo) or die(mysql_error());
              $rows = mysqli_num_rows($result);
              if($rows==1){
                  $errors['esistente']="Username non disponibile";
              }
              elseif($password==$password_2){
                echo "3";
                      $query = "INSERT INTO aziende (Nome, NomeReferente, EmailReferente, Password, Username) 
                              VALUES('$nomeA','$nomeR', '$emailR', '$password, '$username')";
                        mysqli_query($db, $query);
                        $_SESSION['nomeAzienda']=$nomeA;
                        $_SESSION['isLogged']=true;
                        $tipo="azienda";
                        echo "4";
                      $query2 = "INSERT INTO log (username, password, tipo)VALUES('$username','$password', '$tipo')";
                      mysqli_query($db, $query2);
                        //reindirizzamento
                        //header("Location: area_riservata_azienda.php");
              }else
            $errors['noPassword']="Le password non coincidono";   
  }
}

  //LOGIN
   
if (isset($_POST['Login'])){
     
  $username = stripslashes($_REQUEST['username']);
        
  $username = mysqli_real_escape_string($db,$username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($db,$password);
  if (empty($username)) {
    $errors['username']="Username richiesto";
  }
  if (empty($password)) {
    $errors['password']="Password richiesta";
  }
  if (count($errors) == 0) {
        $query = "SELECT * FROM `utenti` WHERE Username='$username' and Password='$password'";
        $result = mysqli_query($db,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
       
        $ris=mysqli_fetch_assoc($result);
        $ruolo=$ris['Ruolo'];
              if($rows==1){
                $_SESSION['username'] = $username;
                $_SESSION['isLogged']= true;
                      //Reindirizzamento 
                if($isOrganize==true){
                  header("Location: registra_tour.php");
                 $isOrganize=false;}
                  else{
                    if($ruolo=='User')
                        header("Location: area_riservata.php");
                      else 
                        header("Location: area_admin.php");
                      }
              }      
  }

}
if(isset($_SESSION['area'])){
  $username=$_SESSION['username'];
  $query = "SELECT * FROM `tour` WHERE Organizzatore='$username' ";
        $result = mysqli_query($db,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

              if($rows==0){
                $tuoitour['vuoto']="Non hai ancora organizzato tour";
               }
                /*else{
                  $count=1;
                  while($row = mysqli_fetch_assoc($result)) { 

                   echo " <p><a href=\"#\" align=\"center\"><".$row['Descrizione']."></a>";
                  $count++; }
                }*/
}



//REGISTRAZIONE TOUR
if (isset($_POST['registrazione_tour'])) {
  // receive all input values from the form
  
  $data = mysqli_real_escape_string($db, $_POST['data']);
  $citta = mysqli_real_escape_string($db, $_POST['citta']);
  $titolo = mysqli_real_escape_string($db, $_POST['titolo']);
  $descrizione = mysqli_real_escape_string($db, $_POST['descrizione']);
  
  if(empty($data)){
    $errors['data']="Data richiesta";
  }
  if(empty($citta)){
    $errors['citta']="Citta' richiesta";
  }
  if(empty($titolo)){
    $errors['titolo']="Titolo richiesto";
  }
  if(empty($descrizione)){
    $errors['descrizione']="Descrizione richiesta";
  }
  
  if(strlen($descrizione)<20){
    $errors['descrizione']="inserire una descrizione di almeno 20 caratteri";
  }
  if (count($errors) == 0) {
    //inserimento del tour nel DB
      $organizzatore=$_SESSION['username'];
        $query = "INSERT INTO tour (data, organizzatore, citta, titolo, descrizione, stato) 
                                VALUES('$data','$organizzatore', '$citta','$titolo', '$descrizione','In attesa')";
                                $result = mysqli_query($db,$query) or die(mysql_error());
    header("Location: area_riservata.php");
  }
}

//MODIFICA PASSWORD
if (isset($_POST['modifica_pw'])) {
  $oldpw = mysqli_real_escape_string($db, $_POST['pwV']);
  $newpw = mysqli_real_escape_string($db, $_POST['pwN']);
  $newpw2 = mysqli_real_escape_string($db, $_POST['pwC']);
  
  if(empty($oldpw)){
    $errors['PasswordError']="Vecchia password richiesta";
  }
  if(empty($newpw)){
    $errors['PasswordError']="Nuova password richiesta";
  }
  if(empty($newpw2)){
    $errors['PasswordError']="Conferma password richiesta";
  }
  $username=$_SESSION['username'];
  $query = "SELECT * FROM `utenti` WHERE Username='$username'";
  $result = mysqli_query($db, $query)or die(mysql_error());
  while ($row = mysqli_fetch_assoc($result)) {
        if($row['Password']!=$oldpw){
          $errors['PasswordError']="Password errata";
        }
  }
  if($newpw != $newpw2){
    $errors['PasswordError']="Le password non corrispondono";
    $errors['PasswordError']="Le password non corrispondono";
  }


    echo count($errorss);

  if (count($errors) == 0) {
   
        $query =" UPDATE `utenti` SET Password='$newpw' WHERE Username='$username'";
              $ris = mysqli_query($db,$query) or die(mysql_error());
    header("Location: area_riservata.php");
  }

}

function setOrganizza(){
    if(!isset($_SESSION["username"])){
     $_SESSION['isOrganize']=true;
    header("Location: login.php");
    
    exit();}
    else    $isOrganize=false;

  }


function getUsernameError($errors) { 
  if(isset($errors['username'])){
      echo $errors['username'];
    }
}
function getNomeError($errors) { 
  if(isset($errors['nome'])){
      echo $errors['nome'];
    }
}
function getCognomeError($errors) { 
  if(isset($errors['cognome'])){
      echo $errors['cognome'];
    }
}
function getEmailError($errors) { 
  if(isset($errors['email'])){
      echo $errors['email'];
    }
}
function getPasswordError($errors) { 
  if(isset($errors['password'])){
      echo $errors['password'];
    }
}
function getPassword2Error($errors) { 
  if(isset($errors['password2'])){
      echo $errors['password2'];
    }
}
function getEsistenteError($errors) { 
  if(isset($errors['esistente'])){
      echo $errors['esistente'];
    }
}
function getNoPasswordError($errors) { 
  if(isset($errors['noPassword'])){
      echo $errors['noPassword'];
    }
}

function getDataError($errors) { 
  if(isset($errors['data'])){
      echo $errors['data'];
    }
}

function getCittaError($errors) { 
  if(isset($errors['citta'])){
      echo $errors['citta'];
    }
}

function getTitoloError($errors) { 
  if(isset($errors['titolo'])){
      echo $errors['titolo'];
    }
}

function getDescrizioneError($errors) { 
  if(isset($errors['descrizione'])){
      echo $errors['descrizione'];
    }
}



function rifiuta()
    {
      $id=$_SESSION['idTour'];
      $db = mysqli_connect('localhost', 'root', 'root', 'irizzo');

        $sql= " UPDATE `tour` SET Stato='Rifiutato' WHERE Id='$id'";
      
        $result = mysqli_query($db,$sql) or die(mysqli_error($db));
    

    }

  function accetta(){

      $id=$_SESSION['idTour'];
      $db = mysqli_connect('localhost', 'root', 'root', 'irizzo');

        $sql= " UPDATE `tour` SET Stato='Approvato' WHERE Id='$id'";
      
        $result = mysqli_query($db,$sql) or die(mysqli_error($db));
    

  }
    function iscriviti(){

      $id=$_SESSION['idTour'];
      $db = mysqli_connect('localhost', 'root', 'root', 'irizzo');
      $username=$_SESSION['username'];
      
        $query = "INSERT INTO partecipa (idTour, Username) 
                                VALUES('$id','$username')";
        $result = mysqli_query($db,$query) or die(mysql_error());
    

  }
  function disiscriviti(){

      $id=$_SESSION['idTour'];
      $db = mysqli_connect('localhost', 'root', 'root', 'irizzo');
      $username=$_SESSION['username'];
      
        $query = "DELETE FROM `partecipa`WHERE idTour='$id' AND Username='$username'";
        $result = mysqli_query($db,$query) or die(mysql_error());
    

  }
?>