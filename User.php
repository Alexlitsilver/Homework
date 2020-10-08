<?php
class User{
  static function addUser(){
    /* Регистрация пользователя (аналог reg_obr.php) */
    $mysqli = mysqli_connect("localhost", "alexlijy_base", "8316KISAkisa1977", "alexlijy_base");
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = mb_strtolower(trim($_POST['email']));
    $pass = trim($_POST['pass']);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    if ($result->num_rows){
      echo "exist";
    }else{
      $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name','$lastname','$email','$pass')");
      echo "success";
    }
  }
  static function authUser(){
    /* Авторизация пользователя (аналог auth_obr.php) */
    $mysqli = new mysqli("localhost", "alexlijy_base", "8316KISAkisa1977", "alexlijy_base");
    $email = mb_strtolower(trim($_POST['email']));
    $pass = trim($_POST['pass']);
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    $row = $result->fetch_assoc();
    if (password_verify($pass,$row['pass'])){
      $_SESSION["name"] = $row["name"];
      $_SESSION["lastname"] = $row["lastname"];
      $_SESSION["email"] = $row["email"];
      $_SESSION["id"] = $row["id"];
      echo "success";
    }else{
      echo "error";
    }
  }
  static function changeUserData(){
    /* Меняет данные пользователя (аналог lk_obr.php) */ 
    $mysqli = mysqli_connect("localhost", "alexlijy_base", "8316KISAkisa1977", "alexlijy_base");
    $value = $_POST['value'];
    $item = $_POST['item'];  // сюда кладется либо name либо lastname
    $userId = $_SESSION['id'];
    $mysqli->query("UPDATE `users` SET `$item`='$value' WHERE `id`='$userId'");
    $_SESSION[$item] = $value;
  }
  static function getUsers(){
    /* Пойду в БД и достану список */
  }
  static function getUser($userId){
    /* Пойду в БД и достану пользователя по его ID */
  }
}
?>