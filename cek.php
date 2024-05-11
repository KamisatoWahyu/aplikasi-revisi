<?php
//kalo dak pernah login
if(isset($_SESSION['log'])){
}else{
    header('location:login.php');
};
?>