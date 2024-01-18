<!DOCTYPE html>
<html lang="en">
    <style>
        table, th, td{
            border: 1px solid black;
        }
    </style>
    <head>
        <title>Form Characters</title>
    </head>

    <body>
        <form name="updateData" action="server.php" method="post">
        <?php
            session_start();
        
            $count = 0;
            foreach ($_SESSION['read'] as $row){
                /* Test.
                echo "</br>-------------48-------------</br>";
                print_r($row);
                */
                echo '
                </br>
                <table>
                    Character: <input type="text" name="charName_' . $count . '" value="' . $row[0] . '">
                    <tr>
                        <td>
                            Energy: <input type="text" name="charEnergy_' . $count . '" value="' . $row[1] . '">
                        </td>
                        <td>
                            Health: <input type="text" name="charHealth_' . $count . '" value="' . $row[2] . '">
                        </td>                    
                    </tr>
                    <tr>
                        <td>
                            Strength: <input type="text" name="charStrength_' . $count . '" value="' . $row[3] . '">
                        </td>
                        <td>
                        Defense: <input type="text" name="charDefense_' . $count . '" value="'. $row[4] . '">
                        </td>
                    </tr>
                </table>
                </br>
                ';
                $count++;
            }            
        ?>
        <input type="submit" value="guardar en fichero" id="save_file" name="save_file">
        <input type="submit" value="guardar en base de datos" id="save_bd" name="save_bd">
        </form>
        <br>   
        
        <form name="chargeFrom" action="server.php" method="post">
            <input type="radio" name="typeUpload"
                value="load_file" checked> Load file<br>
            <input type="radio" name="typeUpload"
                value="load_bd"> Load bd<br>
            
            <input type="submit" value="LOAD!">
        </form>
    </body>
</html>