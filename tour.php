<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
	<?php 
        include_once 'functions.php'; 
	    getHead("Tour");
     ?>        
  </head>

<?php getMenu("Tour");?>
<?php getBreadcumbs("Tour");?>



<h2>Tour disponibili</h2>
<div>
    <?php
        require_once('functions.php');
        $output=getTour();
        $outCat="";
        foreach ($output as $elem) {
            if($elem){
                $outCat.=   "<div class='cardTour'>
                            

                            <p class='titolo'><a href='dettagliTour.php?nome=".$elem['Titolo']."'>".$elem['Titolo']."</a></p>
                           
                            <p class='descrizione'>".$elem['Descrizione']."</a></p>

                            <p class='descrizione'>".$elem['Citta']."</a></p>
                            <p class='descrizione'>".$elem['Data']."</a></p>
                            <p class='descrizione'>".$elem['Organizzatore']."</a></p>
                            
                            
                            </div>";
            }
        }
        echo $outCat;
        unset($outCat);
    ?>
</div>




</div>
</body>
</html>