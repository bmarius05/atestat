<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" href="img/planeticon/planet-32.png">
        <title>T&#226;rgu Mure&#351;</title>
    </head>
    <body>
        <div class="menu">
            <ul>
                <li><a href="index.html">Acasa</a></li>
                <li><a href="galerie.html">Galerie</a></li>
                <li><a href="atractii.html">Atractii</a></li>
                <li class="selected"><a href="vecini.php">Vecini</a></li>
            </ul>
        </div>
        <form>
            <input type=""></input>
        </form>
        <table class="vecini">
        <?php
            echo "<tr>"."<th>"."Nume"."</th>"."<th>"."Populatie"."</th>"."</tr>";
            $sort=array("nume","nume DESC","populatie","populatie DESC");
            $sortby=0;
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
                    while($row = mysqli_fetch_array($tabel)){
                        echo "<tr>"."<td>"."<a class=\"linkt\" href=\"".($row['link'])."\">".($row['nume'])."</a>"."</td>"."<td>".($row['populatie'])."</td>"."</tr>";
                    }
                    $tabel->close();
				}
                $conn->close();
			}
        ?>
        </table>
    </body>
</html>
