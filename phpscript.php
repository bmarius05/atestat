<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link rel="icon" href="img/planeticon/planet-32.png">
        <title>Our Solar System</title>
    </head>
	<body>
		<div class="menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="sun.html">Sun</a></li>
                <li><a href="mercury.html">Mercury</a></li>
                <li><a href="venus.html">Venus</a></li>
                <li><a href="earth.html">Earth</a></li>
                <li><a href="mars.html">Mars</a></li>
                <li><a href="jupiter.html">Jupiter</a></li>
                <li><a href="saturn.html">Saturn</a></li>
                <li><a href="uranus.html">Uranus</a></li>
                <li><a href="neptune.html">Neptune</a></li>
                <li class="selected"><a href="contact.html">Contact</a></li>
            </ul>
        </div>
		<h1>
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
					$conn =  mysqli_connect('localhost','root','DBPassword','users');
					if($conn->connect_error){
						echo "$conn->connect_error";
						die("Conexiune esuata: ". $conn->connect_error);
					} else {
						$verif=$conn->execute_query("select * from users where email='$email' and activa=1;");
						if($verif->num_rows == 1) {
							echo "Acest Email este deja inregistrat";
						}
						else{
							$stmt = $conn->prepare("insert into users(fname, lname, email, tip, mesaj) values(?, ?, ?, ?, ?)");
							$stmt->bind_param("sssss", $firstName, $lastName, $email, $tip, $mesaj);
							$execval = $stmt->execute();
							$result=$conn->execute_query("select id from users where email='$email' and activa=1;");
							$row = $result->fetch_assoc();
							echo "Inregistrare reusita...";
							echo "Id-ul dumneavoastra este:#";
							echo $row['id'];
							$stmt->close();
						}
						$verif->close();
						$conn->close();
					}
				}
			?>
		</h1>
		<br><a href="contact.html" class="link">Inapoi</a>
	</body>
</html>

