<?php

class Session {

    public function __construct() {

        // on lance la session si elle n'est pas déjà lancée
        if (session_status() == PHP_SESSION_NONE)
            session_start();

    }

    public function setMessage($message, $status) {

        $_SESSION['flash'] = array(
            'message'   => $message,
            'status'    => $status,
        );
    }

    public function showMessage() {
        if (!empty($_SESSION['flash'])) {

            $html = "<div class='alert alert-{$_SESSION["flash"]["status"]}' role='alert'>
                {$_SESSION['flash']['message']}</div>";
            echo($html);

            // on supprime le message après l'affichage
            unset($_SESSION['flash']);
        }
    }
}