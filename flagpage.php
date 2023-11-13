<?php
    
    $b_name = $_POST['building_name'];
    $rooms = $_POST['rooms'];
    $number = $_POST['o_number'];
    $address = $_POST['o_address'];
    session_start();
    echo $_SESSION['email1']; 
/////////////////////////////////////////////////////////////////////////////////////////////
$mail = $_SESSION['email1'];  
include_once 'db.php';
$sql = "INSERT INTO `building_details` (`email`, `building_name`, `no_of_rooms`, `o_number`, `o_address`) VALUES ('$mail','$b_name','$rooms','$number','$address')";


if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo "<script>setTimeout(\"location.href = 'http://localhost/tms/owner_building.html';\",1);</script>";
    exit();
} else {
    echo "Some problem occured";
}
mysqli_close($conn);
echo "Values inserted in table";

/*
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
            $mail=$_SESSION['email1'];
            $sql = "INSERT INTO building_details (email,building_name,no_of_rooms,o_number,o_address) VALUES ('$mail','$b_name','$rooms','$number','$address')";
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Sign up completed.\n You can log in")</script>';
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'http://localhost/tms/';\",1);</script>";
            exit();
        }else{
            echo '<script>alert("This email already exist.\n Try another email.")</script>';
            mysqli_close($conn);
            echo "<script>setTimeout(\"location.href = 'http://localhost/tms/';\",1);</script>";
            exit();
        }
                    
    }
    else{
        echo "else part";
    }

*/

?>

<!-- INSERT INTO `building_details` (`email`, `building_name`, `no_of_rooms`, `o_number`, `o_address`) VALUES ('aa@aa', 'aaaa', '4', '9876543210', 'new address is stored here');

 $sql = "INSERT INTO building_details (email,building_name,no_of_rooms,o_number,o_address) VALUES ('$_SESSION['email1']',$b_name','$rooms','$number',$address)";-->