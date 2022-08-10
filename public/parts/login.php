<?php
session_start();
isset($_SESSION["auth"]) && $_SESSION["auth"] == false ? header('Location: ../index.php') : '';
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
?>

<body>
    <?php
    // require_once(dirname(__FILE__) . "/parts/login.php");
    // require_once(dirname(__FILE__) . "/header.php");
    require_once(dirname(__FILE__) . "/loading.php");
    ?>


    <div class="d-flex align-items-center justify-content-center vh-100 bg-danger">
        <div id="login" class="bg-white rounded p-3">
            <div class="d-flex justify-content-center">
                <img src="<?= LINK_LOGO ?>" class="img-fluid" width="450px">
            </div>
            <form action="" method="POST">
                        <input type="text" class="form-control border border-red my-2" id="login_email" placeholder="Usuario..." maxlength="200" minlength="3" required autocomplete="off">
                        <input type="password" class="form-control border border-red my-2" id="login_password" placeholder="Contraseña..." required autocomplete="off">
                        <div style="display:none" id="login_success" class="alert alert-success" role="alert">
                            A simple success alert—check it out!
                        </div>
                        <div style="display:none" id="login_error" class="alert alert-danger" role="alert">
                            A simple success alert—check it out!
                        </div>
                        <button class="btn btn-danger w-100 my-3">Iniciar Sesión</button>
            <p class="text-danger text-center my-3 small">Powered by <a class="text-danger fw-bold text-decoration-none" href="https://azkenservices.com">AZKEN SERVICES</a></p>
                    </form>
                </div>
            </div>

<script>

    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
                data: {
                    action: "login",
                    usuario: $("#login_email").val(),
                    contraseña: $("#login_password").val(),

                },
                url: '../apiController.php',
                method: 'POST',
                dataType: "json",
                beforeSend: function() {
                    $('#login_error').hide();
                    $('#login_success').hide();
                    loading.show();
                }
            })
            .done(function(data) {
                loadingHide();
                $(window).scrollTop(0);
                switch (data.status) {
                    case "exito":
                        $('#login_success').html(data.result);
                        $('#login_success').show();
                        setTimeout(function() {
                            // login.hide();
                            // start_main()
                            window.location.href = "../index"
                        }, 1500);
                        break;
                    default:
                        $('#login_error').html(data.result);
                        $('#login_error').show();
                        break;
                }
            })
    })
</script>