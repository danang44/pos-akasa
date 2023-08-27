<?php echo view('App\Modules\Main\Views\partials\head-main'); ?>

<head>
    <meta charset="utf-8" />
    <title><?= APP_NAME ?> | Login Authentication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content=" Potensi Objek Pajak | Login Authentication" name="description" />
    <meta content=" Potensi OP" name="author" />
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/icon.png">
    <?php echo view('App\Modules\Main\Views\partials\head-css'); ?>
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<?php echo view('App\Modules\Main\Views\partials\body'); ?>
<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="/" class="d-block auth-logo">
                                    <img src="assets/images/<?= LOGO_NAME ?>" alt="" height="28"> <span class="logo-txt"><?= APP_NAME ?></span>
                                </a>
                                <p class="text-muted mt-2"><?= APP_DESC ?></p>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue</p>
                                </div>
                                <form id="form-login" class="custom-form mt-4 pt-2" method="POST" enctype="multipart/form-data" action="/">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label">Password</label>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                    <div class="mb-3 align-items-center align-self-center justify-content-center">
                                        <div id="buttonDiv"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Fleet Management System.<br />Developed with <i class="mdi mdi-heart text-danger"></i> by Direktorat Jenderal Perhubungan Darat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-12">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white"></h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/img/DITJENHubDat-Logo.png" class="avatar-md img-fluid" style="height: 55px !important;" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Fleet Management System</h5>
                                                            <p class="mb-0 text-white-50"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white"></h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="assets/images/NGI.PNG" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Fleet Management System</h5>
                                                            <p class="mb-0 text-white-50"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white"></h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/img/DISHUB-Logo.png" class="avatar-md img-fluid rounded-circle" style="height: 55px !important;" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Fleet Management System</h5>
                                                            <p class="mb-0 text-white-50"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
<!-- JAVASCRIPT -->
<?php echo view('App\Modules\Main\Views\partials\vendor-scripts'); ?>
<!-- password addon init -->
<script src="<?= site_url() ?>assets/js/pages/pass-addon.init.js"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#form-login").submit(function(event) {
            event.preventDefault();
            var $form = $(this);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Mohon ditunggu...",
                onOpen: function() {
                    Swal.showLoading()
                }
            })

            var url = '<?= base_url() ?>/auth/action/login';

            $.post(url, $form.serialize(), function(data) {
                var ret = $.parseJSON(data);
                swal.close();
                if (ret.success) {
                    window.location = "<?= base_url() ?>/main";
                } else {
                    Swal.fire({
                        title: ret.title,
                        text: ret.text,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }).fail(function(data) {
                swal.close();
                Swal.fire({
                    title: 'Error',
                    text: '404 Halaman Tidak Ditemukan',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        });

        window.onload = function() {
            google.accounts.id.initialize({
                client_id: "884122324633-u06ijjlch1912n0l09f7gnkkqlj289ci.apps.googleusercontent.com",
                callback: handleCredentialResponse
            });

            google.accounts.id.renderButton(
                document.getElementById("buttonDiv"), {
                    theme: "outline",
                    size: "large"
                } // customization attributes
            );

            google.accounts.id.prompt(); // also display the One Tap dialog
        }
    });

    function handleCredentialResponse(response) {
        let jwt = parseJwt(response.credential)
        let email = jwt.email;

        loginWithGoogle(email);
    }

    function loginWithGoogle(email) {
        Swal.fire({
            title: "",
            icon: "info",
            text: "Mohon ditunggu...",
            onOpen: function() {
                Swal.showLoading()
            }
        })

        var url = '<?= base_url() ?>/auth/action/loginGoogle';

        $.post(url, {
            email: email,
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        }, function(data) {
            console.log(data);
            var ret = $.parseJSON(data);
            swal.close();
            if (ret.success) {
                window.location = "<?= base_url() ?>/main";
            } else {
                Swal.fire({
                    title: ret.title,
                    text: ret.text,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        }).fail(function(data) {
            swal.close();
            Swal.fire({
                title: 'Error',
                text: '404 Halaman Tidak Ditemukan',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            })
        });
    }

    function parseJwt(token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    };
</script>
</body>

</html>