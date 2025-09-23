<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h2>Array Terindeks</h2>
        <?php 
        $Listdosen = ["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];

        echo "Tanpa Looping : <br>";
        echo $Listdosen[2] . "<br>";
        echo $Listdosen[0] . "<br>";
        echo $Listdosen[1] . "<br>";
        echo "<br>";

        echo "Tanpa Looping : <br>";
        foreach ($Listdosen as $dosen) {
            echo $dosen . "<br>";
        }
        ?>
    </body>
</html>