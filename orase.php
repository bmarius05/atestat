<html lang="ro">
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
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
        <div class="oras">
            <table>
                <?php
                    $start=1;
                    $nrmax=350;
                    $sort=array("nume","nume DESC","judet,populatie DESC","judet DESC,populatie DESC","populatie","populatie DESC","an","an DESC");
                    
                    $conn =  mysqli_connect('localhost','root','','atestat');
                    if(array_key_exists('nume', $_POST)) { 
                        $sortby=0;
                    }else if(array_key_exists('numeD', $_POST)) { 
                        $sortby=1;
                    }else if(array_key_exists('judet', $_POST)) { 
                        $sortby=2;
                    }else if(array_key_exists('judetD', $_POST)) { 
                        $sortby=3;
                    }else if(array_key_exists('populatie', $_POST)) { 
                        $sortby=4;
                    }else if(array_key_exists('populatieD', $_POST)) { 
                        $sortby=5;
                    }else if(array_key_exists('an', $_POST)) { 
                        $sortby=6;
                    }else if(array_key_exists('anD', $_POST)) { 
                        $sortby=7;
                    }else{
                        $sortby=5;
                    }
                    if($conn->connect_error){
                        echo "$conn->connect_error";
                        die("Conexiune esuata: ". $conn->connect_error);
                    } else {
                        $tabel=$conn->execute_query("select * from orase order by $sort[$sortby];");
                        if($tabel->num_rows < 1) {
                            echo "Nu exista date";
                        }
                        else{
                            echo "<tr><form method=\"post\">";
                            if($sortby!=0&&$sortby!=1)
                                echo "<th><input type=\"submit\" name=\"nume\" class=\"th\" value=\"Nume\" /></th>";
                            else if($sortby==0)
                                echo "<th><input type=\"submit\" name=\"numeD\" class=\"th\" value=\"Nume\" /><i class=\"fa fa-angle-up\"></i></th>";
                            else
                                echo "<th><input type=\"submit\" name=\"nume\" class=\"th\" value=\"Nume\" /><i class=\"fa fa-angle-down\"></i></th>";
                            if($sortby!=2&&$sortby!=3)
                                echo "<th><input type=\"submit\" name=\"judet\" class=\"th\" value=\"Judet\" /></th>";
                            else if($sortby==2)
                                echo "<th><input type=\"submit\" name=\"judetD\" class=\"th\" value=\"Judet\" /><i class=\"fa fa-angle-up\"></i></th>";
                            else
                                echo "<th><input type=\"submit\" name=\"judet\" class=\"th\" value=\"Judet\" /><i class=\"fa fa-angle-down\"></i></th>";
                            if($sortby!=4&&$sortby!=5)
                                echo "<th><input type=\"submit\" name=\"populatie\" class=\"th\" value=\"Populatie\" /></th>";
                            else if($sortby==4)
                                echo "<th><input type=\"submit\" name=\"populatietD\" class=\"th\" value=\"Populatie\" /><i class=\"fa fa-angle-up\"></i></th>";
                            else
                                echo "<th><input type=\"submit\" name=\"populatie\" class=\"th\" value=\"Populatie\" /><i class=\"fa fa-angle-down\"></i></th>";
                            if($sortby!=6&&$sortby!=7)
                                echo "<th><input type=\"submit\" name=\"an\" class=\"th\" value=\"Anul Atestării\" /></th>";
                            else if($sortby==6)
                                echo "<th><input type=\"submit\" name=\"anD\" class=\"th\" value=\"Anul Atestării\" /><i class=\"fa fa-angle-up\"></i></th>";
                            else
                                echo "<th><input type=\"submit\" name=\"an\" class=\"th\" value=\"Anul Atestării\" /><i class=\"fa fa-angle-down\"></i></th>";
                            echo"</form></tr>";
                            $i=1;
                            //echo "<tr>"."<th>"."Nume"."</th>"."<th>"."Judet"."</th>"."<th>"."Populatie"."</th>"."<th>"."Anul atestării"."</th>"."</tr>";
                            while(($row = mysqli_fetch_array($tabel))&&$i<$start+$nrmax){
                                if($i>=$start){
                                    echo "<tr>"."<td>";
                                    if($row['link'])
                                        echo"<a class=\"link\" href=\"".($row['link'])."\">".($row['nume'])."</a>";
                                    else
                                        echo ($row['nume']);
                                    echo"</td>"."<td>".($row['judet'])."</td>"."<td>".($row['populatie'])."</td>"."<td>".($row['an'])."</td>"."</tr>";
                                }
                                $i++;
                            }
                            $tabel->close();
                        }
                        $conn->close();
                    }
                ?>
            </table>
        </div>
    </body>
</html>
