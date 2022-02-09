<?php
//https://webinfo.iutmontp.univ-montp2.fr/~petitjeanf/PHP/td-php/TD4/controller/routeur.php?action=readAll

require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerChien.php"));
require_once File::build_path(array("controller", "ControllerFacture.php"));
require_once File::build_path(array("controller", "ControllerFamille.php"));



// On recupère l'action passée dans l'URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = "seConnecter";
}


if (isset($_GET['controller'])) {
    $controller = 'Controller' .$_GET['controller'];
} else if (isset($_POST['controller'])) {
    $controller = 'Controller' .$_POST['controller'];
} else {
    $controller = 'ControllerUtilisateur';
}

if (in_array($action, get_class_methods($controller))) {
    $controller::$action();
}

?>
