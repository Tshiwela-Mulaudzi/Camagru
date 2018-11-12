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

    if ($result['username'] === $login && $result['userPassword'] === $pssword) 
    {
        // echo "right password<br>";
         header('Location: ../showpic.php/');
    }
    else 
    {
      //here should be wrong login pop up or notice
        header('Location: ../index0.php');
        
        echo "Invalid login credentials";
       // echo "<script>setTimeout(\"Location: ../index0.php';\", 1500); </script>;
    }
}
}

catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>