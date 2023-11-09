<?php
    // returns array of PDO driver names
    // print_r(PDO::getAvailableDrivers())

    // connect to database
    $host="localhost";
    $user="root";
    $password="";
    $dbname="employee";

    // data source name
    $dsn="mysql:host=$host;dbname=$dbname";

    // create a PDO instance - open DB connection
    $conn = new PDO($dsn, $user, $password);

    // PDO query set default fetch mode 
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


    // PDO SELECT query 
    $stmt = $conn->query("SELECT * FROM userdata");
   
    // FETCH_ASSOC method fetches the row of a result set as an associative array.
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // for ($i = 0; $i < count($rows); $i++) {
    //     echo $rows[$i]['first_name'] . " " . $rows[$i]['last_name'] . "<br />";
    // }

    // while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //     echo $row['first_name'] . " " . $row['last_name'] . "<br />";
    // }

    //FETCH_OBJ method fetches the row of a result set as an object.
    // $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    // for ($i = 0; $i < count($rows); $i++) {
    //     echo $rows[$i]->first_name . " " . $rows[$i]->last_name . "<br />";
    // }

    // $rows = $stmt->fetchAll();
    // for ($i = 0; $i < count($rows); $i++) {
    //     echo $rows[$i]->first_name . " " . $rows[$i]->last_name . "<br />";
    // }

    // prepared statements
    $gender="male";

    // SELECT STATEMENTS
    // positional parameters to reserve for the actual value
    // $sql="SELECT * FROM userdata WHERE gender = ?";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute([$gender]);
    // $users = $stmt->fetchAll();

    // named parameters to assign the variable
    // $sql="SELECT * FROM userdata WHERE gender = :gender";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute(['gender' => $gender]);
    // $users = $stmt->fetchAll();

    // foreach($users as $user){
    //     echo $user->first_name . " " . $user->last_name . " - " . "$user->gender" . "<br />";
    // }

    // query single record
    // $id = 100;
    // $sql="SELECT * FROM userdata WHERE id = :id";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute(['id' => $id]);
    // $user = $stmt->fetch();
    // echo $user->first_name . " " . $user->last_name . "<br />";

    // query number of rows
    // $sql="SELECT * FROM userdata WHERE gender = :gender";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute(['gender' => $gender]);
    // $usersCount = $stmt->rowCount();
    // echo $usersCount;

   
    // $firstname = "Sheldon";
    // $lastname = "Cooper";
    // $gender = "male";
    // $email = "sheldoncooper@email.com";
    // $id = 1011; // change accordingly

     // INSERT STATEMENT
    // $sql = "INSERT INTO userdata(first_name, last_name, gender, email) VALUES (:first_name, :last_name, :gender, :email)";

    //UPDATE STATEMENT
    // $sql = "UPDATE userdata SET email=:email WHERE id=:id";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute(['email' => $email,
    //                 'id' => $id]);
    // // returns "affected rows"
    // echo $stmt->rowCount();

    // DELETE statement
    // $sql = "DELETE FROM userdata WHERE id=? AND first_name=?";
    // $stmt=$conn->prepare($sql);
    // $stmt->execute([$id, $firstname]);
    //  // returns "affected rows"
    // echo $stmt->rowCount();

    // SEARCH wildcard
    $search = "%as%"; //contains
    $sql="SELECT * FROM userdata WHERE last_name LIKE ?";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$search]);
    $users = $stmt->fetchAll();

    foreach($users as $user){
        echo $user->first_name . " " . $user->last_name . " - " . "$user->gender" . "<br />";
    }

    ### REFERENCE ###
    // https://www.youtube.com/watch?v=OqVNfBQe34k
?>