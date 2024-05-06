<?php
session_start();
?>

<!DOCTYPE html>
<html lang="bg">

<?php include("./views/components/head.php"); ?>

<body>

    <?php include("./views/components/navigation.php"); ?>

    <?php
    // $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

    $request = parse_url($_SERVER['REQUEST_URI'])["path"];
    $viewDir = '/views/';
    $id = '';

    // Some kind of router:
    switch ($request) {
        case '/business/':
        case '/business/home':
            require __DIR__ . $viewDir . 'home.php';
            break;

        case '/business/about':
            require __DIR__ . $viewDir . 'about.php';
            break;

        case '/business/contacts':
            require __DIR__ . $viewDir . 'contacts.php';
            break;

        case '/business/team':
            require __DIR__ . $viewDir . 'team.php';
            break;

        case '/business/events':
            require __DIR__ . $viewDir . 'events.php';
            break;

        case '/business/panel':
            if(isset($_SESSION["isLogged"]) && $_SESSION["role"] == 'admin' && isset($_GET["q"])){
                require __DIR__ . $viewDir . 'panel.php';
            } else {
                http_response_code(401);
                header("Location: ./");
            }
            break;

        case '/business/details':
            if (filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS) && isset($_GET["id"])) {
                $id = $_GET["id"];
                require __DIR__ . $viewDir . 'details.php';
            } else {
                http_response_code(404);
                require __DIR__ . $viewDir . 'notFound.php';
            }

            break;

        case '/business/create':
            if (isset($_SESSION["isLogged"])) {
                require __DIR__ . $viewDir . 'create.php';
            } else {
                require __DIR__ . $viewDir . 'login.php';
            }

            break;

        case '/business/edit':
            if (isset($_SESSION["isLogged"])) {
                require __DIR__ . $viewDir . 'edit.php';
            } else {
                require __DIR__ . $viewDir . 'login.php';
            }

            break;

        case '/business/login':
            if (isset($_SESSION["isLogged"])) {
                http_response_code(403);
                require __DIR__ . $viewDir . 'home.php';
            } else {
                require __DIR__ . $viewDir . 'login.php';
            }

            break;

        case '/business/register':
            if (isset($_SESSION["isLogged"])) {
                http_response_code(403);
                require __DIR__ . $viewDir . 'home.php';
            } else {
                require __DIR__ . $viewDir . 'register.php';
            }

            break;

        case '/business/email-verification':
            require __DIR__ . $viewDir . 'verifyEmail.php';
            break;

        case '/business/logout':
            if (isset($_SESSION["isLogged"])) {
                session_destroy();
                header("Location: ./home");
            } else {
                require __DIR__ . $viewDir . 'home.php';
            }

            break;
        default:
            http_response_code(404);
            require __DIR__ . $viewDir . 'notFound.php';
    }
    ?>


    <?php include("./views/components/footer.php"); ?>

</body>

</html>