<html>
 <head>
 <Title>Form input data siswa</Title>
 </head>
 <body>
 <h1>Input data siswa disini!</h1>
 <p>Isi dengan benar, lalu klik <strong>Submit</strong> untuk input data.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama  <input type="text" name="nama" id="nama"/></br></br>
       Kelas <input type="text" name="kelas" id="kelas"/></br></br>
       Jurusan <input type="text" name="jurusan" id="jurusan"/></br></br>
       <input type="submit" name="submit" value="Submit" />
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
            $nama = $_POST['nama'];
            $kelas = $_POST['kelas'];
            $jurusan = $_POST['jurusan'];
            $date = date("Y-m-d");

            // Insert data
            $sql_insert = "INSERT INTO cikup (nama, kelas, jurusan, waktu) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $nama);
            $stmt->bindValue(2, $kelas);
            $stmt->bindValue(3, $jurusan);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Data berhasil diinput!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM dbo.cikup";
            $stmt = $conn->query($sql_select);
            $siswa = $stmt->fetchAll(); 
            if(count($siswa) > 0) {
                echo "<h2>List Data Siswa:</h2>";
                echo "<table>";
                echo "<tr><th>Nama</th>";
                echo "<th>Kelas</th>";
                echo "<th>Jurusan</th>";
                echo "<th>Waktu</th></tr>";

                foreach($siswa as $siswa) {
                    echo "<tr><td>".$siswa['nama']."</td>";
                    echo "<td>".$siswa['kelas']."</td>";
                    echo "<td>".$siswa['jurusan']."</td>";
                    echo "<td>".$siswa['waktu']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>Tidak ada data yang diinput!.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>
