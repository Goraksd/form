<?php
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=utf-8">
    <title>Форма</title>
</head>
<body>
    <main class="form">
    <div class="form_wrapper">
        <form action="handler.php" method="POST" id="cvform" enctype="multipart/form-data">
        
            <input type="email" name="email" id="email" placeholder="E-mail" required>
            <input type="text" name="message"  id="message" placeholder="Комментарий" required>
            <input type="file" id="file" multiple="multiple" name="screen" accept=".jpg, .jpeg, .png, .pdf, .gif, .bmp"  > 
            <input type="submit" value="Отправить"> 
            <span id="msg"></span>
          
        </form>

    </div>
    </main>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="form.js"></script>
</body>
</html>