<?php 
session_start();
include('credentials.php');

	$populate = $conn->prepare("SELECT * FROM $picturetable"); 
	$populate->execute();
	$results = $populate->fetchAll(PDO::FETCH_ASSOC);
	$resultscounter = $populate->rowCount();
	$row = $populate->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="./form/main.css" rel="stylesheet">
	<title>Camagru</title>
	<form action = '../logout.php' method = 'POST'>
		<input class = "allButs" id = "logout" type = "Submit" value = "Logout">
	</form>
</head>
<body>
<h1>Camagru</h1>

<?php if ($resultscounter): ?>
	<?php foreach($results as $key => $value): ?>
		<div class="picture">
			<img class = 'card-img-top' name = "nameofinput" src ="<?= $value['pic']; ?>" alt = '' width = '450px'>
			<!-- Likes form -->
			<form action = 'likes.php?pic_id=<?= $value['pictureID']; ?>' method = 'post'>
				<div class = 'comment-block'>
					<input type="hidden" name="pic-id" value="<?= $value['pictureID']; ?>">
					<button type='submit' class='btn btn-outline-primary like' value='like' name='like'>Like</button>
					<br/>					
					<?php
					$pic_id = $value['pictureID'];
					$query = $conn->prepare("SELECT likes FROM gallery WHERE pictureID=:pic_id");
					$query->bindParam(":pic_id",$pictureID,PDO::PARAM_STR);
					$query->execute();
					echo $value['likes']."  like(s)"; //maybe the total from database
					 ?>
				</div>
			</form>
			<!-- /Likes form -->
			
			<!-- Comments form -->
			<?php $id = $row['pictureID'];
					//echo $id;
			?>
			<form action = 'comments.php?pic_id="<?= $value['pictureID']; ?>"' method = 'post'>
				<div class = 'comment-block'>
					<input type="hidden" name="pic-id" id="send
					"  value=<?php $id ?>>
					<input class='box' placeholder='Comment here..' name='comment' >
					<input type='submit' class = "button" value='comment' name="send" >
					<br/>
					<?php 
						$pic_id = $value['pictureID'];
						$query = $conn->prepare("SELECT comment FROM comments WHERE pic_id=:pic_id");
						$query->bindParam(":pic_id",$pic_id,PDO::PARAM_STR);
						$query->execute();
						while($row = $query->fetch(PDO::FETCH_ASSOC))
						{
							echo "<p>".$row['comment']."</p>";
						}
						$usernamefromsession = $_SESSION['sessionUsername'];
						//send mail when someone comments
						$subjectline = "New comment";
						$messagetext = "Hey
						$usernamefromsession left a comment on your picture.
						
Regards,
Camagru";
						$head = 'From registartion@camagru.co.za'."\n\r";
						$email = $value['useremail'];
						mail($email, $subjectline, $messagetext, $head);
					?>
				</div>
			</form> 
			<!-- /Comments form -->
			
		</div>
		<br> 
	<?php endforeach; ?>
<?php endif; ?>
</body>
</html>