<?php

    if(isset($POST['btnLogin']))
    {
        if(Token::validateToken($POST['_once_default'])){
            $username = $POST['username'] ?? null;
            $password = $POST['password'] ?? null;
            if(User::Login($username, $password))
            {
                echo 'LOGGED IN!';
                Router::RedirectToDefault();
                exit;
            }else{
                $msg = new FlashMessages();
                $msg->error('Forkert bruggernavn/password.', null, true);
            }
        }else{
            echo 'SESSION udløbet eller noegt...', var_dump($_SESSION);
        }
    }
?>
<form action="" method="post">    
    <?=Token::createTokenInput();?>

        <div class="mdl-cell mdl-cell--12-col">
            <h1>Login</h1>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
           <?php $msg = $msg ?? new FlashMessages(); echo  @$msg->hasErrors() ? $msg->display() : null; ?>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield">
              <input class="mdl-textfield__input" type="text" id="username" name="username" required>
              <label class="mdl-textfield__label" for="username">Username</label>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                <label class="mdl-textfield__label" for="password">Password</laPel>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--4-col mdl-cell--3-offset">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" name="btnLogin">
                Login
            </button>
        </div>
    
</form>