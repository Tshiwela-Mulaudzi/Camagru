<?php
include('credentials.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "successfully connected<br>";
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}

try {
$login = $_POST['username'];
$pssword = $_POST['password'];

$populate = $conn->prepare("SELECT * FROM $tablename 
WHERE username = :username AND userPassword = :pssword");
$populate->bindParam(":username", $login);
$populate->bindParam(":pssword", $pssword);
$populate->execute();

$result = $populate->fetch(PDO::FETCH_ASSOC); 

//foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
 {
   // echo $v;

    print_r($result);
    if ($result['activated'] == '1')
    {
        if ($result['username'] === $login && $result['userPassword'] === $pssword) 
        {
        $_SESSION['sessionUsername'] = $result['username'];
        $_SESSION['sessionEmail'] = $result['email'];
        // echo "right password<br>";
         header('Location: ../takeapic.html');
        }
        else 
        {
      //here should be wrong login pop up or notice
        header('Location: ../index.php');
        
        echo "Invalid login credentials";
       // echo "<script>setTimeout(\"Location: ../index0.php';\", 1500); </script>;
        }
    }
    else
    {
        header('Location: http://127.0.0.1:8080/Camagru/activated.html');
    }
}
}

catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>