<?php

    function debuguear($variable): string{
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }

    function s($html): string{
        $s = htmlspecialchars($html);
        return $s;
    }

    function current_page($path){

        return str_contains( $_SERVER['PATH_INFO'], $path);
    }

    function is_authenticated() :bool{
        session_start();
        return !empty($_SESSION['name']) && !empty($_SESSION);
    }

    function is_admin(): bool{
        session_start();
        return !empty($_SESSION['admin']);
    }