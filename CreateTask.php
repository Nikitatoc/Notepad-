<?php require "head.html" ?>
<div style="margin-top: 15%">
    <a class="esc" href="AllTask.php"><</a>
    <h1 id="TaskName">Назва завдання...</h1>
</div>


<form method="post" action="CreateTask.php">
    <div class="TaskParameters">
        <input type="radio" id="work"
        name="task" value="work">
        <label for="work" style="font-size: 300%; margin-left: 5%">Робочі</label>

        <input type="radio" id="personal"
               name="task" value="personal">
        <label for="personal" style="font-size: 300%; margin-left: 5%">Особисті</label>
    </div>

    <div class="TaskParameters">
        <textarea id="text" cols="40" rows="5" placeholder="Додати опис..." name="text"></textarea>
    </div>

    <div class="TaskParameters">
        <input type="text" placeholder="Дата завершення:" id="date" name="date">
    </div>

    <div class="TaskParameters">
        <input type="radio" name="urgently" value="терміново"  id="urgently">
        <label for="urgently" style="font-size: 300%; margin-left: 5%">Термінове</label>
    </div>

    <div>
        <button type="submit" id="Create">Створити</button>
    </div>
</form>
<?php
$ID =6;
$Task=$_POST['text'];
$date=$_POST['date'];
$urgently=$_POST['urgently'];
$TypeTask=$_POST['task'];

if($urgently==''){
    $urgently= "не терміново ";
}

$dns='mysql:host=localhost;dbname=List';
$pdo= new PDO($dns, 'root','root');

$sqlId = 'SELECT (id) as count FROM users WHERE user=?';
$queryId = $pdo->prepare($sqlId);
$queryId->execute([$_COOKIE['email']]);
$ID = $queryId->fetch();
$id=$ID[0];

if($TypeTask=='work') {
    $sqlCommand = 'INSERT INTO labor(id, task , time, urgently) VALUES (:id, :task, :tim, :urgently)';
    $query = $pdo->prepare($sqlCommand);
    $query->execute(['id'=>$id, 'task' => $Task, 'tim' => $date, 'urgently' => $urgently]);
}
if($TypeTask=='personal'){
    $sqlCommand = 'INSERT INTO personal(id, task , time, urgently) VALUES (:id, :task, :tim, :urgently)';
    $query = $pdo->prepare($sqlCommand);
    $query->execute(['id'=>$id, 'task' => $Task, 'tim' => $date, 'urgently' => $urgently]);
}
?>
