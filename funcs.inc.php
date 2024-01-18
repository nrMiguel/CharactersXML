<?php
    function tratarDOMdocs($domDOC){
        $xpath = new DOMXPath($domDOC);
        
        $charactersDOM = $xpath->query("//character");
        $elements = $xpath->query("//character/*"); 
    
        for($i=1; $i<=sizeof($charactersDOM); $i++){
            $atributosCharacter = $xpath->query("//character[$i]/*");
    
            $count=0;
            foreach($atributosCharacter as $elm){
                $table[$i-1][$count] = $elm->nodeValue;;
                $count++;
            }
    
        }
        $_SESSION['read'] = $table;
    }

    function readXML(){
        if(file_exists('test_xml.xml')) {
            //Haciéndolo con la clase DOMDocument.
            $domDOC = new DOMDocument();
            $domDOC->load("test_xml.xml") or die("Error: Cannot load xml.");

            echo " funcs.inc.php line 30";
            print_r($domDOC);
            //die();
            
            tratarDOMdocs($domDOC);
        } else {
            exit('Failed to open test_xml.xml.');
        }
    }

    function readBD(){
        // Conectamos a BD
        PDOConn::$dbname = 'practicaM06UF3';
        PDOConn::connect();

        $domDOC = new DOMDocument();
        $download = PDOConn::read();
        $domDOC->loadXML($download[0][1]);

        tratarDOMdocs($domDOC);

        //print_r($download);
        //echo ($download[0][1]);
        //print_r($domDOC);
        //die();        
    }

    function validateData($table){
        for($i=0; $i<3; $i++){
            echo 'nombre personaje ' . $i . '? ' . $_POST['charName_' . $i] . '</br>';
            if(isset($_POST['charName_' . $i])){
                $table[$i][0]=$_POST['charName_' . $i];

                if($_POST['charName_' . $i]==""){
                    echo 'No se ha añadido el nombre del personaje ' . $i . '</br>';
                    die();
                }
            } else {
                echo 'No se ha añadido el nombre del personaje ' . $i . '</br>';
                die();
            }

            echo 'energía personaje ' . $i . '? ' . $_POST['charEnergy_' . $i] . '</br>';
            if(isset($_POST['charEnergy_' . $i])){
                $table[$i][1]=$_POST['charEnergy_' . $i];

                if($_POST['charEnergy_' . $i]==""){
                    echo 'No se ha añadido la energía del personaje ' . $i . '</br>';
                    die();
                }
            } else {
                echo 'No se ha añadido la energía del personaje ' . $i . '</br>';
                    die();
            }

            echo 'vida personaje ' . $i . '? ' . $_POST['charHealth_' . $i] . '</br>';
            if(isset($_POST['charHealth_' . $i])){
                $table[$i][2]=$_POST['charHealth_' . $i];

                if($_POST['charHealth_' . $i]==""){
                    echo 'No se ha añadido la vida del personaje ' . $i . '</br>';
                    die();
                }
            } else {
                echo 'No se ha añadido la vida del personaje ' . $i . '</br>';
                die();
            }

            echo 'energía personaje ' . $i . '? ' . $_POST['charStrength_' . $i] . '</br>';
            if(isset($_POST['charStrength_' . $i])){
                $table[$i][3]=$_POST['charStrength_' . $i];

                if($_POST['charStrength_' . $i]==""){
                    echo 'No se ha añadido la fuerza del personaje ' . $i . '</br>';
                    die();
                }
            } else {
                echo 'No se ha añadido la fuerza del personaje ' . $i . '</br>';
                die();
            }

            echo 'defensa personaje ' . $i . '? ' . $_POST['charDefense_' . $i] . '</br>';
            if(isset($_POST['charDefense_' . $i])){
                $table[$i][4]=$_POST['charDefense_' . $i];

                if($_POST['charDefense_' . $i]==""){
                    echo 'No se ha añadido la defensa del personaje ' . $i . '</br>';
                    die();
                }
            }  else {
                echo 'No se ha añadido la defensa del personaje ' . $i . '</br>';            
                die();
            }
        }
         // Test: Una vez revisamos que estén todas los datos de los formularios llenos...
        echo "todos los datos establecidos. funcs.inc.php line 127</br>";
        print_r($table);

        return $table;
    }

    function createXML($table){
        echo "creando xml.  funcs.inc.php line 134</br>";
        $doc = new DOMDocument();
        $doc->formatOutput = true;
        
        $root = $doc->createElement('juego');
        $root = $doc->appendChild($root);
        
        foreach($table as $row){
            $subRoot = $doc->createElement('character');
            $root->appendChild($subRoot);

            $charName = $doc->createElement('name');
            $charName->nodeValue = $row[0];
            $subRoot->appendChild($charName);

            $charEnergy = $doc->createElement('energy');
            $charEnergy->nodeValue = $row[1];
            $subRoot->appendChild($charEnergy);

            $charHealth = $doc->createElement('health');
            $charHealth->nodeValue = $row[2];
            $subRoot->appendChild($charHealth);

            $charStrenght = $doc->createElement('strenght');
            $charStrenght->nodeValue = $row[3];
            $subRoot->appendChild($charStrenght);

            $charDefense = $doc->createElement('defense');
            $charDefense->nodeValue = $row[4];
            $subRoot->appendChild($charDefense);            
        }
        
        return $doc;
    }
?>