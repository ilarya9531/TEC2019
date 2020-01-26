<?php
include_once 'server.php';

function tabIndex($tabindex) {
    $tabindex=$tabindex+1;
    echo "tabindex='$tabindex' ";
    
}
function getHead($current){
echo"

	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	

	<title>$current</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='title' content='VenetoTour' />
    <meta name='description' content='Tour in veneto' />
    <meta name='keywords' content='Tour, veneto, gite, padova, vicenza, venezia, treviso, rovigo, verona, belluno' />
    <meta name='language' content='it' />
    <meta name='author' content='Rizzo Ilaria, Romito Sara, Vasile Tusa, Salviato Alberto' />
    <meta name='viewport' content='width=device-width, initial-scale = 1.0' />

	<link rel='stylesheet'  href='stileila.css'/ >
    <script src='js/menu-hamburger.js'></script>


	<link rel='icon' 
      type='image/png' 
      href='img/favicon.png' alt='immagine favicon'>
	
";
}

function getFooter(){echo"

    <footer>
        <div class='container'>     
            <div>&copy; 2019 <span lang='it'>Veneto Eventi </span>Torre Archimede, Via Trieste, 63, 35121 Padova PD (<span lang='it'>Italia</span>)
            </div>
            <div> email: venetoeventi@gmail.com </div>
            <div> tel: +39 123456789 </div>

            <div class='torna-su'>   
            <a class='scritta-torna-su' href='#' >TORNA SU</a>
            </div>
        </div>  
    </footer>

</html>";
}

function getMenu($current){
    
    echo "<body>
    <header>
            <div >
            <div class='topnav' id='myTopnav'>
                <div class='sx-logo'>
                    <a class='logo-pulsante fontlogo' href = 'home.php' tabindex='1' accesskey='v'> VENETO EVENTI </a>
                </div>
                <div class='pos'></div>
            
                <div class='header-right'>
                    <ul>";
                        if((isset($_SESSION['usernameU']))or(isset($_SESSION['usernameA']))){
                            echo "<li><a class='a-menu-log' href='logout.php' tabindex='2' >Logout</a></li>";}
                        else{
                            echo"<li><a class='a-menu-log  ";if($current=="Login"){echo"active";}echo" 'href='login.php' tabindex='2' accesskey='l'> Login</a></li>";
                        }
                        echo "<li><a class='a-menu-log ";if($current=="Registrati"){echo"active";}echo" ' href='registrazione_utente.php' tabindex='3' accesskey='r'>Registrati</a></li>  
                    </ul>
                </div>
                <div class='end'></div>
                <div>
            </div>

            <div class='end'></div>

            <div class='header-right' id='padd'>
                <ul>
                   <li><a class='a-menu-log ";if($current=="Home"){echo"active" ;}echo"' href='home.php' tabindex='4' accesskey='h'>Home</a></li>
                   
                   
                   <li><a class='a-menu-log ";if($current=="Eventi"){echo"active";}echo"' href='eventi.php' tabindex='5' accesskey='e'>Eventi</a></li>";
                    
                    if(isset($_SESSION['usernameU'])){
                        
                        echo"<li><a class='a-menu-log ";if($current=="AreaRiservata"){echo"active";}echo" ' href='area_riservata_utente.php' tabindex='6' accesskey='a'>Area personale</a></li>";
                    }
                         
                    if(isset($_SESSION['usernameA'])){
                        
                        echo"<li><a  class='a-menu-log  "; if($current=="AreaRiservata"){echo"active";}echo"' href='area_riservata_azienda.php' tabindex='6' accesskey='a'>Area personale</a></li>";
                    }

                    echo"<li><a class='a-menu-log' href='contatti.php'"; if($current=="Contatti"){echo"class='active'";}echo " tabindex='7' accesskey='c'>Contatti</a></li>
            
                </ul>
                <div class='end'></div>
            </div>

            <a href='javascript:void(0);' class='icon' onclick='myFunction()' tabindex='8' accesskey='s'> 
                    <div class='icon-menu pos1-icon'></div>
                    <div class='icon-menu pos2-icon'></div>
                    <div class='icon-menu pos3-icon'></div>
            </a>
        <div>
    </header>

";
}


function getBreadcumbs($current){
echo "<div class='contenitore'>
			<p id='breadcumb'>Sei in : ".$current."</p>
        </div>
  ";
}

function getMessage(){
	if(isset($_SESSION['isOrganize'])){
		echo "
		<p id='messaggio'>Per iscriverti agli eventi devi accedere con le tue credenziali,<br> se è la prima volta devi prima <a href='registrazione_utente.php' tabindex='1' accesskey='s'>registrati</a href></p>";
	}
}


function getEventiAzienda(){
    $azienda=$_SESSION['usernameA'];
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `eventi` WHERE azienda='$azienda' ";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventiAzienda']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventiAzienda']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}
function getEventiTutti(){
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `eventi`";

    $ris = mysqli_query($db,$sql);
    $errore = array();

    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventi']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventi']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}
function getEventiPrefe(){
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `preferiti`";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventiPrefe']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventiPrefe']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}
function getEventiIscritto(){
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM `partecipa`";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventiIscritto']=false;
        //array_push($errore,"Errore della query: " . $sql);
    }else {$_SESSION['eventiIscritto']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
}
function getEventoDettagli($id){
    echo $id;
      $db = mysqli_connect('localhost', 'root', '', 'irizzo');

    $sql = "SELECT * FROM `eventi` WHERE Id='$id'";
    $ris = mysqli_query($db,$sql)or DIE("evento: ".mysqli_error($db));
    $output = mysqli_fetch_assoc($ris);
    return $output;
}

function setIscrivitiBottone(){
    $idEvento= $_SESSION['idEvento'];
    if(isset($_SESSION['usernameU'])){
        $username= $_SESSION['usernameU'];
            $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    

        $sql = "SELECT * FROM `partecipa` WHERE id='$idEvento' AND Username='$username' ";

        $ris= mysqli_query($db, $sql);
    
        if(mysqli_num_rows($ris)==0){
            $output= "<form action='' method='post'>
                                    <input type='submit' name='iscriviti' value='ISCRIVITI'  class='scritte-iscriviti' />

                </form>";
                       }
        else{
            $output="<form action='' method='post'>
                                    <input type='submit' name='disiscriviti' value='DISISCRIVITI'  class='scritte-iscriviti' />

                </form>";
        }
    
    }elseif(isset($_SESSION['usernameA'])){ 
        $username= $_SESSION['usernameA'];
        $db = mysqli_connect('localhost', 'root', '', 'irizzo');
        $sql = "SELECT * FROM `eventi` WHERE id='$idEvento' AND Azienda='$username' ";

        $ris= mysqli_query($db, $sql);
        if(mysqli_num_rows($ris)==0){
            $output="<p class='scritte-dettagli' style='color:red'> *per iscriverti a un evento devi prima accedere.</p>";
                       }
        else{
            $output="<form action='' method='post'>
                                    <input type='submit' name='elimina' value='ELIMINA'  class='scritte-iscriviti' />

                </form>";
        }

    }
     else   $output="<p class='scritte-dettagli' style='color:red'> *per iscriverti a un evento devi prima accedere.</p>";
    
    return  $output;
}



function setPreferitiBottone(){
    $idEvento= $_SESSION['idEvento'];
    $output="";
    if(isset($_SESSION['usernameU'])){
        $username= $_SESSION['usernameU'];
            $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    

        $sql = "SELECT * FROM `preferiti` WHERE id='$idEvento' AND Username='$username' ";

        $ris= mysqli_query($db, $sql);
    
        if(mysqli_num_rows($ris)==0){
            $output= "<form action='' method='post'>
                                    <input type='submit' name='preferiti' value=''  class='scritte-preferiti prefe' />

                </form>";
                       }
        
        
        else{
                                                            

            $output="<form action='' method='post'>
                                    <input type='submit' name='nopreferiti' value=''  class='scritte-preferiti noprefe' />

                </form>";
        }    

    }
    return  $output;
}

function getUltimiEventi(){
    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    $sql = "SELECT * FROM ( SELECT * FROM `eventi` ORDER BY ID DESC LIMIT 3 ) as r ORDER BY ID";
    $ris = mysqli_query($db,$sql);
    $errore = array();
    if(mysqli_num_rows($ris)==0){
        $_SESSION['eventi']=false;
    }else {$_SESSION['eventi']=true;}
    $output = array();
    while ($row = mysqli_fetch_assoc($ris)) {
        array_push($output,$row);
    }
    array_push($output,$errore);
    return $output;
    
}

function getImg($id){
    $location='uploads/';
    if(file_exists($location.$id.'.png')){
        $output=$location.$id.'.png';
        
    }
    elseif(file_exists($location.$id.'.jpg')){
        $output=$location.$id.'.jpg';
    }
    else {
        $location='img/';
        $output=$location.'locandina.jpg';
    }
    return $output;
}



function getAccountU(){
        $utente= $_SESSION['usernameU'];
        

    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    

    $sql = "SELECT * FROM `utenti` WHERE username='$utente' ";
    
    $ris = mysqli_query($db,$sql);
    $output = mysqli_fetch_assoc($ris);
    return $output;

}

function getAccountA(){
        $azienda= $_SESSION['usernameA'];
        

    $db = mysqli_connect('localhost', 'root', '', 'irizzo');
    

    $sql = "SELECT * FROM `aziende` WHERE username='$azienda' ";
    
    $ris = mysqli_query($db,$sql);
    $output = mysqli_fetch_assoc($ris);
    return $output;

}


?>


