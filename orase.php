<html lang="ro">
    <head>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" href="img/steag/steag50x50.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset = "utf-8" />
        <title>România</title>
    </head>
    <body>
        <nav>
            <input type="checkbox" id="check"></input>
            <label for="check" class="checkbtn">
                <i class="fa fa-bars" id="checkbx"></i>
            </label>
            <img class="logo" src="img/steag/steag150x100.png"></img>
            <ul>
                <li><a href="./index.html">Acasă</a></li>
                <li><a href="./atractii.html">Atracții</a></li>
                <li><a href="./galerie.html">Galerie</a></li>
                <li><a href="./orase.php">Orașe</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <table class="oras">
            <?php
                $sort=array("nume","nume DESC","judet","judet DESC","populatie","populatie DESC","an","an DESC");
                $sortby=5;
                $conn =  mysqli_connect('localhost','root','DBPassword','atestat');
                if($conn->connect_error){
                    echo "$conn->connect_error";
                    die("Conexiune esuata: ". $conn->connect_error);
                } else {
                    $tabel=$conn->execute_query("select * from orase order by $sort[$sortby];");
                    if($tabel->num_rows < 1) {
                        echo "Nu exista date";
                    }
                    else{
                        echo "<tr>"."<th>"."Nume"."</th>"."<th>"."Judet"."</th>"."<th>"."Populatie"."</th>"."<th>"."Anul atestării"."</th>"."</tr>";
                        while($row = mysqli_fetch_array($tabel)){
                            echo "<tr>"."<td>";
                            if($row['link'])
                                echo"<a class=\"link\" href=\"".($row['link'])."\">".($row['nume'])."</a>";
                            else
                                echo ($row['nume']);
                            echo"</td>"."<td>".($row['judet'])."</td>"."<td>".($row['populatie'])."</td>"."<td>".($row['an'])."</td>"."</tr>";
                        }
                        $tabel->close();
                    }
                    $conn->close();
                }
            ?>
        </table>
    </body>
</html>
