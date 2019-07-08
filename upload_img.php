<?php
require_once 'vendor/autoload.php';
require_once "./random_string.php";
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
$connectionString = "DefaultEndpointsProtocol=https;AccountName=strgcikupapp;AccountKey=tbixwRohFQj+wPMFK9sHeJpNyy47Yn68V0o1+VWZjR9MonR0iZURA4fqFYxT05Jjt3SVJ3UIJmFUfL9+YsKXhQ==;EndpointSuffix=core.windows.net";
$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = "cikupqueue";
if (isset($_POST['submit'])) {
	$fileToUpload = $_FILES["fileToUpload"]["name"];
	$content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
	echo fread($content, filesize($fileToUpload));
	$blobClient->createBlockBlob($containerName, $fileToUpload, $content);
	header("Location: upload_img.php");
}
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$result = $blobClient->listBlobs($containerName, $listBlobsOptions);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Analyze With Upload Photo</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">
		<!-- Bootstrap core CSS -->
		<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="starter-template.css" rel="stylesheet">
		 <style>
		 body{
			 margin: 100px;
			 font-size:18pt;
		 }
	</style>
	</head>
	<body>
		<form class= "form-inline" action="upload_img.php" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
			<input class="btn btn-primary mb-2" type="submit" name="submit" value="Upload">
		</form>
		<br>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th>Nama File</th>
					<th>URL Gambar</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
					<?php
					do {
						foreach ($result->getBlobs() as $blob) {
					?>
						<tr>
							<td><?php echo $blob->getName() ?></td>
							<td><?php echo $blob->getUrl() ?></td>
							<td>
								<form action="img_vision.php" method="post">
									<input type="hidden" name="url" value="<?php echo $blob->getUrl()?>">						
									<input class="btn btn-info" type="submit" name="submit"  value="Lihat">
								</form>
							</td>
						</tr>
						<?php
							} $listBlobsOptions->setContinuationToken($result->getContinuationToken());
						} while($result->getContinuationToken());
						?>
					</tbody>
 				</table>
				</div>
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
			<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
			<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
			</body>
		</html>