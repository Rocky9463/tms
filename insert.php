<?php
    include_once 'db.php';
    if(isset($_POST['submit']))
    {    
        $sql = "select oemail from owner_data";
        $result = mysqli_query($conn, $sql);
        $flag = 0;
        $email = $_POST['email'];
        while($row = mysqli_fetch_assoc($result)) {
            if($row["oemail"]==$email){
                $flag=1;
            }
        }
        if ($flag==0){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $passwrd = $_POST['passwd'];
            $sql = "INSERT INTO owner_data (oname,oemail,opasswd) VALUES ('$name','$email','$passwrd')";
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Sign up completed.\n You can log in")</script>';
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'http://localhost/tms/indexlog.html';\",1);</script>";
            exit();
        }else{
            echo '<script>alert("This email already exist.\n Try another email.")</script>';
            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'http://localhost/tms/indexlog.html';\",1);</script>";
            exit();
        }
                    
    }
    else{
        echo "else part";
    }
?>