<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input data siswa</title>
</head>
<style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Isi disini!</h1>
 <p>Silahkan isi dengan benar :) <strong>Kirim</strong> untuk memamsukkan data siswa.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama  <input type="text" name="nama" id="nama"/></br></br>
       Kelas <input type="text" name="kelas" id="kelas"/></br></br>
       Jurusan <input type="text" name="jurusan" id="jurusan"/></br></br>
       <input type="submit" name="submit" value="Kirim" />
       <input type="submit" name="load_data" value="Muat Data" />
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
            $name = $_POST['nama'];
            $email = $_POST['kelas'];
            $job = $_POST['jurusan'];
            // Insert data
            $sql_insert = "INSERT INTO dbo.cikup (nama, kelas, jurusan) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $job);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>People who are Insert:</h2>";
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
                echo "<h3>No one is currently Inserted.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
</html>
