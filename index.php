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
            <div>
                <h1>City Cykler</h1>
                <h2>cykler i alle prisklasser</h2>
            </div>
            <div>
                <form action="#search" method="post">
                    <input type="text" name="searchVal" id="searchVal"><br>
                    <button>Søg</button>
                </form>
            </div>
        </header>
    </section>
    <section id="mainContainer">
        <header>
            <nav>
                <a href="#">Forsiden</a>
                <a href="#">Cykler</a>
                <a href="#">Udstyr</a>
                <a href="#">Kontakt</a>
                <a href="#">Nyheder</a>
            </nav>
        </header>
        <section id="mainContent">
            <?php require_once Router::GetView(); ?> 
        </section>
        <footer>
        </footer>
    </section>
</body>
</html>