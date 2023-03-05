<!DOCTYPE html>
<html>

<head>
	<title>Aplikasi Pengirim Email</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

	<div class="container">
		<div class="col-lg-8">
			<div class="page-header">
				<br>
				<h3>Aplikasi Pengirim Email By Elseif Channel</h3>
			</div>
			<form action="Kirim.php" method="post">
				<div class="form-group">
					<label>Email Tujuan</label>
					<input type="text" name="tujuan" class="form-control">
				</div>
				<div class="form-group">
					<label>Subjek</label>
					<input type="text" name="subjek" class="form-control">
				</div>
				<div class="form-group">
					<label>Pesan</label>
					<textarea name="pesan" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="Kirim" value="Kirim Pesan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>

</body>

</html>
<!-- Elseif Channel -->