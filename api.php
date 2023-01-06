<?php require "head.html"
?>

<?php

$email= $_POST['email'];
$password= $_POST['password'];


if(isset($_POST['email'])) {
    setcookie('email', $email, time() + 3600);
}

$dns='mysql:host=localhost;dbname=List';
$pdo= new PDO($dns, 'root','root');





$sql = 'SELECT count(id) as count FROM users WHERE user=?';
$query = $pdo->prepare($sql);
$query->execute([$email]);
$count_users = $query->fetch();
?>
<?php if ((int)$count_users['count'] === 0):
    $sqlCheck='INSERT INTO users(user, password) VALUES (:email, :password)';
    $query=$pdo->prepare($sqlCheck);
    $query->execute(['email'=>$email, 'password'=>$password]);
    echo 'Ваш аккаунт створено'
    ?>

<?php else: ?>



       <?php $queryPassword=$pdo ->query("SELECT `password` FROM `users` WHERE user='$email'");
        while ($row=$queryPassword->fetch(PDO::FETCH_OBJ)){
        $TruePassword=$row->password;
        }
        if($password===$TruePassword){
            header('location:AllTask.php');
        }
        else{
            echo 'Ви ввели невірний пароль';
        }
        ?>

<?php endif; ?>



</body>
</html>
