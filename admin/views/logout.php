<?php
    unset($_SESSION);
    session_destroy();
    Router::Redirect('/Login');
    exit;
