<html>
 <head>
 <Title>Registration Form</Title>
 </head>
 <body>
 <h1>Register here!</h1>
 <p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama  <input type="text" name="nama" id="nama"/></br></br>
       Kelas <input type="text" name="kelas" id="kelas"/></br></br>
       Jurusan <input type="text" name="jurusan" id="jurusan"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" />
 </form>

 <?php

 $host = "cikupwebserver.database.windows.net";
    $user = "mozeeb";
    $pass = "zeeb@123";
    $db = "cikupdb";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
 
 
 
    if (isset($_POST['submit'])) {
        try {
            $nama = $_POST['nama'];
            $kelas = $_POST['kelas'];
            $jurusan = $_POST['jurusan'];
            // Insert data
            $sql_insert = "INSERT INTO cikup (nama, kelas, jurusan) 
                        VALUES (?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $nama);
            $stmt->bindValue(2, $kelas);
            $stmt->bindValue(3, $jurusan);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM dbo.cikup";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Nama</th>";
                echo "<th>Kelas</th>";
                echo "<th>Jurusan</th>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['nama']."</td>";
                    echo "<td>".$registrant['kelas']."</td>";
                    echo "<td>".$registrant['jurusan']."</td>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>
