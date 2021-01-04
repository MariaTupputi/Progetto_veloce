<?php
    $link = mysqli_connect("localhost", "root", "root", "utenze");
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }   
    mysqli_close($link);
?>
<html>
    <head>
        <title>Elenco utenti citt&agrave;</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>Scegli la citt&agrave; nell'elenco</p>
            <input type="submit" name="invio" value="Cerca"/>
            <input type="submit" name="aggiorna" value="Aggiorna"/>
            <select name="Citta">
                <option value="Roma">Roma</option>
                <option value="Milano">Milano</option>
                <option value="Bari">Bari</option>
                    <?php
                        $sql="SELECT DISTINCT Citta FROM $tab_nome ORDER BY Citta";
                        $result= mysql_query($sql);
                        while($row=mysql_fetch_array($result))
                        {
                            echo"<option value=\"".$row['Citta']."\">" . $row['Citta'] . "</option> \n";
                        }
                    ?>
            </select>
            <input type="submit" name="invio" value="Cerca"/>
            <input type="submit" name="aggiorna" value="Aggiorna"/>
        </form>
        <?php
            if(isset($_POST['aggiorna'])){
                header("Location:" .  $_SERVER['PHP_SELF']);
            }
            if(isset($_POST['invio'])){
                $Citta=$_POST["Citta"];
                echo "<h2>Elenco utenti: citt&agrave; = ". $Citta . "</h2> \n";
                $sql="SELECT * FROM $tab_nome WHERE Citta LIKE '%$citta'";
                $result=mysql_query($sql);
            ?>
            <table border="1">
                <tr>
                    <th>Codice</th>
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Citta</th>
                </tr>
                <?php  
                    while($row=mysql_fetch_array($result))
                    {
                        echo "<tr> \n";
                        echo "<td>" . $row["Codice"] . "</td> \n";
                        echo "<td>" . $row["Cognome"] . "</td> \n";
                        echo "<td>" . $row["Nome"] . "</td> \n";
                        echo "<td>" . $row["Citta"] . "</td> \n";
                        echo "</tr> \n";
                    }
                }
                ?>
            </table>
    </body>
</html>
