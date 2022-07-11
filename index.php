<?php
require_once __DIR__ . "/vendor/autoload.php";

use MongoDB\Client;

$db = new \MongoDB\Client("mongodb://127.0.0.1/");
$db = $db->lesson_list->lesson;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2</title>
    <script src="script.js"></script>
</head>
<div>
    <div style="display: flex">
        <form action="" method="post">
            <label for="group">Group: </label>
            <select name="group" id="group">
                <?php
                $statement = $db->distinct("group");
                foreach ($statement as $data) {
                    echo "<option value='$data'>$data</option>";
                }
                ?>
            </select>
            <input type="submit" onclick="save()"><br>
        </form>
        <?php
        if (isset($_POST["group"])) {
            $statement = $db->find(['$and' => [['group' => $_POST["group"]], ['type' => 'Laboratory']]]);
            echo "<div id='save'>";
            foreach ($statement as $data) {
                echo "<b> Day: </b>{$data['week_day']}; <b> Lesson: </b>{$data['lesson_number']}; <b> Auditorium: </b> {$data['auditorium']}; <b> Disciple: </b> {$data['disciple']}; <b> Group: </b> {$data['group']}<br>";
            }
            echo "</div>";
        }
        ?>
    </div>
    <div style="display: flex">
        <form action="" method="post">
            <label for="teacher">Group: </label>
            <select name="teacher" id="teacher">
                <?php
                $statement = $db->distinct("teacher");
                foreach ($statement as $data) {
                    echo "<option value='$data'>$data</option>";
                }
                ?>
            </select>

            <label for="disciple">Group: </label>
            <select name="disciple" id="disciple" onclick="save()">
                <?php
                $statement = $db->distinct("disciple");
                foreach ($statement as $data) {
                    echo "<option value='$data'>$data</option>";
                }
                ?>
            </select>
            <input type="submit" onclick="save()"><br>
        </form>
        <?php
        if (isset($_POST["teacher"])) {
            $statement = $db->find(['$and' => [['teacher' => $_POST["teacher"]], ['disciple' => $_POST["disciple"]], ['type' => 'Lecture']]]);
            echo "<div id='save'>";
            foreach ($statement as $data) {
                echo "<b> Day: </b>{$data['week_day']}; <b> Lesson: </b>{$data['lesson_number']}; <b> Auditorium: </b> {$data['auditorium']}; <b> Disciple: </b> {$data['disciple']}; <b> Group: </b> {$data['group']}<br>";
            }
            echo "</div>";
        }
        ?>
    </div>

    <div style="display: flex"></div>
    <form action="" method="post">
        <input type="hidden" name="auditorium">
        <input type="submit" value="Find auditoriums" onclick="save()"><br>
    </form>
    <?php
    if (isset($_POST["auditorium"])) {
        $statement = $db->distinct("auditorium");
        echo "<div id='save'> <b> Auditoriums: </b> <br>";
        foreach ($statement as $data) {
            echo "$data;<br>";
        }
        echo "</div>";
    }
    ?>
</div>
<div id="content"></div>
<input type="button" value="Load" onclick="load()">
</body>
</html>
