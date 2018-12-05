<html>
<body>
  <?php
  $host = "db.tecnico.ulisboa.pt";
  $user = "ist425496";
  $pass = "abjq7123";
  $dsn = "mysql:host=$host;dbname=$user";
  try
  {
    $connection = new PDO($dsn, $user, $pass);
  }
  catch(PDOException $exception)
  {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
    exit();
  }
  $name = $_REQUEST['name'];
  $VAT_client=$_REQUEST['VAT_client'];
  $species_name = $_REQUEST['species_name'];
  $colour = $_REQUEST['colour'];
  $gender= $_REQUEST['gender'];
  $birth_year = $_REQUEST['birth_year'];
  $age=$_REQUEST['age'];

  $sql = $connection->prepare("INSERT into animal values(:animal_name,:VAT_owner,:species_name,:colour,:gender,:birth_year,:age)");
  $test = $sql->execute([':animal_name' => $name,
                 ':species_name'=>$species_name,
                 ':VAT_owner'=>$VAT_client,
                 ':colour'=>$colour,
                 ':gender'=>$gender,
                 ':birth_year'=>$birth_year,
                 ':age'=>$age]);
  if ($test == FALSE) {
    //are you trying to insert an existing animal? ;)
    $info = $sql->errorInfo();
    echo("<p>Error: {$info[2]}</p>");
    exit();
  }
  else
  {
    //header("Location: animals.php");
    echo("<p>Animal inserted with success</p>");
    echo(" <form action='check.php' method='post'>
    <h3>Go back to homepage</h3>
    <p><input type='submit' value='Homepage'/></p>
    </form>");
  }
  ?>
</body>
</html>
