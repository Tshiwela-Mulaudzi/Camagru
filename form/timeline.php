<?php include('credentials.php');

	$populate = $conn->prepare("SELECT * FROM $picturetable"); 
	$populate->execute();
	$results = $populate->fetchAll(PDO::FETCH_ASSOC);
	$resultscounter = $populate->rowCount();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="./form/main.css" rel="stylesheet">
	<title>Camagru</title>

</head>
<body>
<h1>Camagru</h1>

<?php if ($resultscounter): ?>
	<?php foreach($results as $key => $value): ?>
		<div class="picture">
			<img class = 'card-img-top' src ="<?= $value['pic']; ?>" alt = ''>
			<!-- Likes form -->
			<form action = 'likes.php' method = 'post'>
				<div class = 'comment-block'>
					<input type="hidden" name="pic-id" value="<?= $value['pictureID']; ?>">
					<button type='submit' class='btn btn-outline-primary like' value='like' name='like'>Like</button>
				</div>
			</form>
			<!-- /Likes form -->
			<!-- Comments form -->
			<form action = 'comments.php' method = 'post'>
				<div class = 'comment-block'>
					<input type="hidden" name="pic-id" value="<?= $value['pictureID']; ?>">
					<textarea class='txt_comment form-control' placeholder='Comment here..' rows='3' name="comment"></textarea>
					<button type='submit' class='btn btn-outline-primary comments' value='send' name='send'>Comment</button>
				</div>
			</form> 
			<!-- /Comments form -->
			
		</div>
		<br> 
	<?php endforeach; ?>
<?php endif; ?>
</body>
</html>


