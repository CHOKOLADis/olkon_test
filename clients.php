<?include 'db.php';ini_set('display_errors','off');
error_reporting('E_ALL');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <title>Autoservice.org/clients</title>
</head>
<body>
<header class="header">
    <div class="container">
        <?
        if (isset($_SESSION['logged_user'])) { 
            echo '
            <div class="success">
                <span>Вы зашли под логином <b>'.$_SESSION["logged_user"].'</b> </span>
                <div class="links">
                    <a href="logout.php">Выйти</a>
                </div>
            </div>';  
        }	
        ?>
        <div class="list_contacts">
        <ul>
            
            <?
                $i=0;
                $query2 =  mysqli_query($connect,"SELECT * FROM `clients`");
                $n = mysqli_num_rows($query2);
                if (isset($_SESSION['logged_user'])) { 
                    if ($_SESSION['logged_user']=="admin") { 
                        echo '<form action="#" method="POST">';
                        while($r = mysqli_fetch_array($query2)){
                            echo "
                            <li>
                                <input type='text' name='fname' id='fname' value='{$r[fname]}' >
                                <input type='text' name='sname' id='sname' value='{$r[sname]}' >
                                <input type='text' name='tname' id='tname' value='{$r[tname]}' >
                                <input type='text' name='date_record' id='date_record' value='{$r[date_record]}' >
                                <input type='text' name='num_car' id='num_car' value='{$r[num_car]}' >
                                "?><a class="btn del" alt="Удалить" href='?del=<?=$r['id']?>'>х</a><? echo "
                            </li>
                            ";
                            $i++;   
                        }
                        echo "
                        </form >
                        <form action='#' method='POST' id='add_form' class='add_form'>
                            <div class='add_item'>
                                <input type='text' name='fname' id='fname' placeholder='Фамилия' >
                                <input type='text' name='sname' id='sname' placeholder='Имя' >
                                <input type='text' name='tname' id='tname' placeholder='Отчество' >
                                <input type='date' name='date_record' id='date_record' placeholder='Дата занесения' >
                                <input type='text' name='num_car' id='num_car' placeholder='Номер машины' >

                            </div>
                            <input type='submit' name='submit' id='submit' value='Отправить' >
                        </form>
                        <div class='controls'>
                            <a href='#add_form' class='btn add'>Добавить запись</a>
                            <a href='?update' class='btn upd'>Отправить изменения на сервер</a>
                        </div>";
                        if (isset($_GET['del'])) {
                            $id=$_GET['del'];
                            $query3 = mysqli_query($connect,"DELETE FROM `clients` WHERE id=$id");
                            echo "Запись была удалена";
                        }
                    }
                    else {
                        while($r = mysqli_fetch_array($query2)){
                            echo "
                            <li>
                                <p>{$r[fname]} </p>
                                <p>{$r[sname]}</p>
                                <p>{$r[tname]} </p>
                                <p>{$r[date_record]}</p>
                                <p>{$r[num_car]}</p>
                            </li>
                            ";
                            $i++;   
                        }
                    }	
                }	            
            ?>
            
        </ul>
        </div>
    </div>
</header>


<script src="js/main.js"></script>
</body>
</html>