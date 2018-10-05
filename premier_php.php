<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> premier PHP </title>
    </head>

    <body>
        du code HTML<br/>
        <?php 
            $abc = 12;
            $def = 3.14;
            $ghi = 'un simple texte';
            
            echo 'Du code PHP : ' . $ghi . '<br/>';
            
            for ($i = 1; $i <= 10; $i++)
            {
                echo 'i = ' . $i . '<br/>';
                echo "i = $i <br/>";
            }       
        
        ?>
    </body>
</html>
