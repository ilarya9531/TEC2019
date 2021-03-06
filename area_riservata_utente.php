<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">


<head>
	<?php 
        include_once 'functions.php'; 
	    getHead("AreaRiservata");
	    $_SESSION['area']=true;
     ?>        
  </head>
<?php getMenu("AreaRiservata");?>

<?php getBreadcumbs("Area personale");?>
<div class="pageArea">

<div class="box1">
    
    <div class="area-titoli">
        <h1 class="titolo ">Benvenuto nella tua area personale <?php echo $_SESSION['usernameU']; ?>!</h1>
        <p class="titolo "> Qui troverai gli eventi salvati e quelli a cui sei iscritto</p>
    </div>
    <div class="area-bottoni">
        <a class="bottone-area link" href="modifica_pw.php">
         Cambia password</a>
         <a class="bottone-area link" href="modifica_account.php">Modifica account</a>
    </div>
</div>
<div class="box-left-area preferiti" >
<?php
            require_once('functions.php');
            $tuoiTour=getEventiPrefe();
            $tour=getEventiTutti();
            $outCat="";
            $tab=9;
            if($_SESSION['eventiPrefe']===true){
                $outCat.="<h1 class='titolo'> Preferiti</h1>";

            foreach ($tuoiTour as $elem) {
              
                if($_SESSION['eventi']===true){
                foreach ($tour as $key) {
                    
                    if($key&&$elem){
                    if($elem['ID']==$key['ID']){
                    $outCat.=   "<div class='evento-1 box-evento1 piccolo'>
                                        <div class='box-img'>
                                            <img class='img-evento' src='".getImg($key['ID'])."' alt='immagine evento'>
                                        </div>
                                        <div class='box-titolo'>
                                            <div class='box-icona'></div>
                                                <p class='scritte-evento'>".$key['Titolo']."</p>
                                        </div>
                                        <div class=\"box-categoria \">
                                            <div class=\"box-icona\"></div>
                                            <p class=\"scritte-evento\">".$key['Categoria']."</p>
                                        </div>
                                        <div class=\"box-data\">
                                            <div class=\"box-icona\">
                                                <div id=\"calendario\"></div>
                                            </div>
                                            <div class=\"box-data-evento\">
                                                <p class=\"scritte-evento\">".$key['Data']."</p>
                                            </div>
                                        </div>
                                        <div class=\"box-descr\">
                                            <div class=\"box-icona\"></div>
                                            <p class=\"scritte-evento\"> ".$key['Descrizione']."</p>
                                        </div>
                                        <div class=\"box-luogo \">
                                            <div class=\"box-icona\">
                                                <div id=\"local\"></div>
                                            </div>
                                            <div class=\"box-luogo-evento\">
                                                <p class=\"scritte-evento\">".$key['Luogo']."</p>
                                            </div>
                                        </div>
                                        <div class=\"box-dettagli\">
                                        <div class=\"box-icona\">
                                                
                                        </div>
                                            <div >

                                                <a href='dettagli_evento.php?id=".$key['ID']."' class='scritte-dettagli selezione link' tabindex='".tabIndex($tab)."'>DETTAGLI</a>
                                                
                                            </div> 
                                             
                                        </div>
                                    </div>";
                                break;
                }
                $tab=$tab+1;
            }
             
        }}
        


    }}  else{$outCat.= "<div><h3> Non ci sono eventi in preferiti. <a href='eventi.php' class='messageTour' tabindex='".tabIndex($tab)."' accesskey='i'> Scopri </a>gli eventi!</h3></div>";}
        echo $outCat;
        unset($outCat);
    ?>
        
    </div>
    <div class="box-right-area iscrizioni">

    <?php
            require_once('functions.php');
            $tuoiTour=getEventiIscritto();
            $tour=getEventiTutti();
            $outCat="";
            if($_SESSION['eventiIscritto']===true){
                $outCat.="<h1 class=\"titolo\"> Iscrizioni</h1>";

            foreach ($tuoiTour as $elem) {
              
                if($_SESSION['eventi']===true){
                foreach ($tour as $key) {
                    
                    if($key&&$elem){
                    if($elem['ID']==$key['ID']){
                    $tab=$tab+1;
                    $outCat.=   "
                                    <div class=\"evento-1 box-evento1 piccolo\">
                                        <div class=\"box-img\">
                                            <img class=\"img-evento\" src=\"".getImg($key['ID'])."\" alt=\"immagine evento\">
                                        </div>
                                        <div class=\"box-titolo\">
                                            <div class=\"box-icona\"></div>
                                                <p class=\"scritte-evento\">".$key['Titolo']."</p>
                                        </div>
                                        <div class=\"box-categoria \">
                                            <div class=\"box-icona\"></div>
                                            <p class=\"scritte-evento\">".$key['Categoria']."</p>
                                        </div>
                                        <div class=\"box-data\">
                                            <div class=\"box-icona\">
                                                <div id=\"calendario\"></div>
                                            </div>
                                            <div class=\"box-data-evento\">
                                                <p class=\"scritte-evento\">".$key['Data']."</p>
                                            </div>
                                        </div>
                                        <div class=\"box-descr\">
                                            <div class=\"box-icona\"></div>
                                            <p class=\"scritte-evento\"> ".$key['Descrizione']."</p>
                                        </div>
                                        <div class=\"box-luogo \">
                                            <div class=\"box-icona\">
                                                <div id=\"local\"></div>
                                            </div>
                                            <div class=\"box-luogo-evento\">
                                                <p class=\"scritte-evento\">".$key['Luogo']."</p>
                                            </div>
                                        </div>
                                        <div class=\"box-dettagli\">
                                        <div class=\"box-icona\">
                                                
                                        </div>
                                            <div >
                                                
                                                <a href='dettagli_evento.php?id=".$key['ID']."' class='scritte-dettagli selezione link' tabindex='".tabIndex($tab)."'>DETTAGLI</a>
                                            </div> 
                                             
                                        </div>
                                    </div>";
                                break;
                }}
             
        }}

    }} else{
            $tab=$tab+1;
            $outCat.= "<div><h3> Non ci sono eventi a cui sei iscritto. <a href='eventi.php' class='messageTour' tabindex='".tabIndex($tab)."' accesskey='s'> Iscriviti </a>al tuo primo evento!</h3></div>";}
        echo $outCat;
        unset($outCat);
    ?>
            
    
</div>
</div>
</body>
<?php getFooter() ?>