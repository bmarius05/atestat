<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" href="img/planeticon/planet-32.png">
        <title>Our Solar System</title>
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
		<div class="formular">
			<p class="center">
				<?php
					$firstName = $_POST['fname'];
					$lastName = $_POST['lname'];
					$email = $_POST['email'];
					$tip = $_POST['tip'];
					$mesaj = $_POST['mesaj'];

					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "Email invalid";
					}else{
						// Database connection
						$conn =  mysqli_connect('localhost','root','','atestat');
						if($conn->connect_error){
							echo "$conn->connect_error";
							die("Conexiune esuata: ". $conn->connect_error);
						} else {
							$verif=$conn->execute_query("select * from users where email='$email';");
							if($verif->num_rows == 1) {
								echo "Acest Email este deja inregistrat";
							}
							else{
								$stmt = $conn->prepare("insert into users(fname, lname, email, tip, mesaj) values(?, ?, ?, ?, ?)");
								$stmt->bind_param("sssss", $firstName, $lastName, $email, $tip, $mesaj);
								$execval = $stmt->execute();
								$result=$conn->execute_query("select id from users where email='$email';");
								$row = $result->fetch_assoc();
								echo "Inregistrare reusita...";
								echo "Id-ul dumneavoastra este:#";
								echo $row['id'];
<<<<<<< HEAD
								echo "</p><p class=\"center\">Vă mulțumim pentru mesaj!";
=======
								echo "</p><p>Vă mulțumim pentru mesaj!";
>>>>>>> fd27d9761c98072c5fb494e449bb60e47ecd003b
								$stmt->close();
							}
							$verif->close();
							$conn->close();
						}
					}
				?>
			</p>
			<p class="center">
			<input type="submit" value="Inapoi" onclick="javascript:history.back()"></p>
		</div>
	</body>
</html>

