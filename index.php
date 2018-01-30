<?php
    
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
    //require_once __DIR__ . DIRECTORY_SEPARATOR . 'Guard-class.php';
  

    Router::SetDefaultRoute('/Home');
    Router::SetViewFolder(__DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

    Router::AddEndpoint('/Home','home.php');


    Router::Init($_SERVER['REQUEST_URI']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Cykler</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <section id="headerLayout">
        <header>
        
        </header>
    </section>
    <main>
        <?php require_once Router::GetView(); ?> 
    </main>
    <footer>
    </footer>
</body>
</html>