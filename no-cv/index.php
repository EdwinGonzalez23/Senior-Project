<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="camstyle.css">
</head>

<body>
    <br>
    <center>
        <section>
            <article>
                <!-- Show Web Camera -->
                <div class="display-cover">
                    <video autoplay></video>
                    <canvas class="d-none"></canvas>
                    <div class="video-options">
                        <select name="" id="" class="custom-select">
                            <option value="">Select camera</option>
                        </select>
                    </div>
                    <img class="screenshot-image d-none" alt="">
                    <div class="controls">
                        <button class="btn btn-danger play" title="Play">
                            <i data-feather="play-circle"></i></button>
                        <button class="btn btn-info pause d-none" title="Pause">
                            <i data-feather="pause"></i></button>
                        <button class="btn btn-outline-success screenshot d-none" title="ScreenShot">
                            <i data-feather="image"></i></button>
                    </div>
                </div>
                <!-- End Camera -->
                <h3>Welcome</h3>
                <p>We are currently in the process of setting up logins.
                    <br>If you are a host or a server, please login temporarily.
                    <br>Thank you!
                    <!-- Button for Host and Server -->
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Host</h4>
                            <div class="btn-group btn-group-lg">
                                <a href="hostpage.html" class="btn btn-info" data-toggle="modal"
                                    data-target="#modalLoginForm" role="button">Login</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4>Server</h4>
                            <div class="btn-group btn-group-lg">
                                <a href="server.html" class="btn btn-info" role="button" data-toggle="modal"
                                    data-target="#modalLoginForm" role="button">Login</a>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!-- End button section -->
    </center>
    </p>
    </article>
    </section>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <!-- <form id="login-form" action="php_scripts/login.php" method="post"> -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>

                    <form id="login-form" action="php_scripts/login.php" method="post">
                        <input type="hidden" name="pos" id="hidden-id1" value="pos">
                        <input type="hidden" name="id" id="hidden-ids1" value="id">
                        <input type="submit" name="username" id="defaultForm-pass1" class="form-control validate"
                            value="name here">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass"></label>
                    </form>

                </div>
                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    
                    <form id="login-form" action="php_scripts/login.php" method="post">
                    <input type="hidden" name="pos" id="hidden-id2" value="pos">
                    <input type="hidden" name="id" id="hidden-ids2" value="id">
                    <input type="submit" name="username" id="defaultForm-pass2" class="form-control validate"
                        value="name here">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass"></label>
                    </form>

                </div>
                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>

                    <form id="login-form" action="php_scripts/login.php" method="post">
                    <input type="hidden" name="pos" id="hidden-id3" value="pos">
                    <input type="hidden" name="id" id="hidden-ids3" value="id">
                    <input type="submit" name="username" id="defaultForm-pass3" class="form-control validate"
                        value="name here">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass"></label>
                    </form>

                </div>
                <div class="md-form mb-4">

                    <button class="btn btn-default">Not you?</button>
                </div>

            </div>

            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-default">Login</button>
            </div>

        </div>
    </div>
    </div>
    <!-- </form> -->

    <br>
    <br>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="js/camscript.js"></script>

    <script src="js/getID.js"></script>
    <script>
        $("#login-form").submit(function (e) {
            // e.preventDefault();
        });
    </script>
</body>

</html>