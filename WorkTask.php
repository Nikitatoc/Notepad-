<?php require "head.html"?>

<div style="margin-top: 10%">
        <a href="AllTask.php" class="TypeTasks" >Усі</a>
        <a href="WorkTask.php" class="TypeTasks" id="all">Робочі</a>
        <a href="personal.php" class="TypeTasks">Особисті</a>
    </div>

<?php
$dns='mysql:host=localhost;dbname=List';
$pdo= new PDO($dns, 'root','root');


$sqlId = 'SELECT (id) as count FROM users WHERE user=?';
$queryId = $pdo->prepare($sqlId);
$queryId->execute([$_COOKIE['email']]);
$ID = $queryId->fetch();
$id=$ID[0];


echo '<ul style="margin-top: 20%">';

$query=$pdo ->query("SELECT * FROM `labor` WHERE id='$id'");
while ($row=$query->fetch(PDO::FETCH_OBJ)){
    echo '<li>'.$row->task. '<input type="checkbox" id="done">'.'<br>'.$row->time. '<br>' .$row->urgently.'</li>';
}
echo '</ul>';
?>
    <form action="CreateTask.php">
        <button id= "CreateButton">+</button>
    </form>
