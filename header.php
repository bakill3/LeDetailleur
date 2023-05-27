<?php 
include 'ligar_db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require 'phpmailer/vendor/autoload.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

if (isset($_POST['enviar'])) {
    $nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['nome']));
    $email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
    $telemovel = htmlspecialchars(mysqli_real_escape_string($link, $_POST['telemovel']));
    $data = $_POST['data'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($nome) && !empty($email) && !empty($telemovel) && is_numeric($telemovel) && !empty($data)) {
        //mysqli_query($link, "INSERT INTO reservas (nome, email, telefone, data) VALUES ('$nome', '$email', '$telemovel', '$data');");

        if (isset($_POST['checkbox']) && $_POST['checkbox'] == 'on') {
            $checkbox = 1;
        } else {
            $checkbox = 0;
        }

        $stmt = $link->prepare("INSERT INTO reservas (nome, email, telefone, data, checkbox) VALUES (?, ?, ?, ?, ?);");
        $stmt->bind_param("ssssi", $nome, $email, $telemovel, $data, $checkbox);
        $stmt->execute();
        $stmt->close();

        //MAIL

        $mail = new PHPMailer();

        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';
        $mail->isSMTP();
        $mail->Mailer = "smtp";

        $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        //to view proper logging details for success and error messages
        $mail->SMTPDebug = 1;
        $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->Username = 'lifepageshop123@gmail.com';   //email
        $mail->Password = 'slpgvdadjxgvnmup' ;   //16 character obtained from app password created
        $mail->Port = 465;                    //SMTP port
        $mail->SMTPSecure = "ssl";

        //sender information
        $mail->setFrom('lifepageshop123@gmail.com', 'Le Detailleur');

        //receiver email address and name
        $mail->addAddress($email, $nome); 

        // Add cc or bcc   
        // $mail->addCC('email@mail.com');  
        // $mail->addBCC('user@mail.com');  


        $mail->isHTML(true);

        $mail->Subject = 'Réservation effectuée avec succès.';
        $mail->Body    = "<h3> Votre réservation a été réservée </h3>
        <p>Merci de nous avoir choisi <b>$nome</b>.</p> 
        <p>Il est prévu pour la date <b>$data</b></p><hr>
        <i>L’équipe Le Détailleur</i>";

        // Send mail   
        if (!$mail->send()) {
            echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }

        $mail->smtpClose();

        header('Location: index.php?success=true');        
        exit(0);
    } else {
        header('Location: index.php?error=true');        
        exit(0); 
    }

    //echo "<script>window.location.href='index.php'</script>";
    //header('Location: index.php');
    //exit(0);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Le Detailleur - Acceuil</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css"> 
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header style="    background: rgba(30, 40, 51, 1) !important;
    color: white !important;
    box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.7);
    z-index: 1000 !important;
    position: relative;
    width: 100% !important;">
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/logo/logo_rounded.png" alt="" style="width: 60px;"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="index.php" class="menu_text" style="color: white;">Acceuil</a></li>
                                                <li><a href="about.php" class="menu_text" style="color: white;">À propos</a></li>
                                                <li><a href="services.php" class="menu_text" style="color: white;">services</a></li>
                                                <li><a href="blog.php" class="menu_text" style="color: white;">Commentaires</a>
                                                    <ul class="submenu">
                                                        <li><a href="blog.php" class="menu_text" style="color: white;">Blog</a></li>
                                                        <li><a href="blog_details.php" class="menu_text" style="color: white;">Blog Details</a></li>
                                                        <li><a href="elements.php" class="menu_text" style="color: white;">Element</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="contact.php" class="menu_text" style="color: white;">Contacter</a></li>
                                                <li><a href="#" id="reservar_lavagem" class="btn header-btn" data-toggle="modal" data-target="#exampleModal" style="color: white;">Réserver un lavage</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header-btn -->
                                    <div class="header-right-btn d-none d-lg-block ml-20">
                                        <a href="#" class="btn header-btn" data-toggle="modal" data-target="#exampleModal"><img src="assets/img/icon/smartphone.svg" alt="">Réserver un lavage</a>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <?php if (isset($_GET['success']) && $_GET['success'] == "true"): ?>
            <div class="alert alert-success" role="alert">
                Réservation effectuée avec succès. Un email vous a été envoyé.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == "true"): ?>
            <div class="alert alert-danger" role="alert">
                Données invalides
            </div>
        <?php endif; ?>



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Faites votre réservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <h1>Réserver un lavage</h1>
                        <div style="padding: 5%;">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom et prénom</label>
                                    <input type="text" name="nome" class="form-control"placeholder="Nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Numéro de téléphone</label>
                                    <input type="number" class="form-control" placeholder="+41 767184842" name="telemovel" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date de réservation</label>
                                    <input id="datetime-local" type="datetime-local" class="form-control" name="data" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkbox" checked>
                                    <label class="form-check-label" for="exampleCheck1">Je souhaite recevoir des offres et réductions via Newsletter</label>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
              var input = document.getElementById("datetime-local");
              if (input !== null) {
                var date = new Date();
                date.setDate(date.getDate() + 2);
                input.setAttribute("min", date.toISOString().slice(0, 16));
            } else {
                console.error("Could not find input element with id 'datetime-local'");
            }
        });
    </script>

    <div style="position: fixed; left: 1%; bottom: 1%; margin: 0; z-index: 999;">
        <a href="https://wa.me/41767184842?text=Bonjur!" class="fa fa-whatsapp"></a>
        <a href="https://www.instagram.com/le.detailleur" target="_blank" class="fa fa-instagram"></a>
    </div>