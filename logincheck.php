<?php
    include_once 'db.php';
    if(isset($_POST['submit']))
    {    
        $sql = "select * from owner_data";
        $result = mysqli_query($conn, $sql);
        $flag = 0;
        $email = $_POST['email'];
        $passwrd = $_POST['passwd'];
        while($row = mysqli_fetch_assoc($result)) {
            if($row["oemail"]==$email && $row["opasswd"]==$passwrd){
                $name1 = $row["oname"];
                $flag = 1;
            }
        }
        if ($flag==1){
            session_start();
            $_SESSION['name1'] = $name1;
            $_SESSION['email1'] = $email;

            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'owner_building.html';\",1);</script>";
            exit();
        }else{
            echo '<script>alert("Invalid Email or Password.\nPlease try again.")</script>';
            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'http://localhost/tms/indexlog.html';\",1);</script>";
            exit();
        }
                    
    }
    else{
        echo "else part";
    }
?>