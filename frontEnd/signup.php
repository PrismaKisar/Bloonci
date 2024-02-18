<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Sign up • Bloonci</title>
    <link rel="icon" href="../images/misc/logo_bloonci_380x380.png" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="../javaScript/checkForm.js"></script>
    <script defer src="../javaScript/checkSignupEmail.js"></script>
    <script src="../javaScript/citiesAndProvinces.js"></script>

</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-8 col-sm-9">
                    <div class="text-center pt-4">
                        <img src="../images/misc/logo_bloonci.png" alt="logo" width="150">
                    </div>
                    <div class="text-center pb-2">
                        <img src="../images/misc/scritta_bloonci.png" alt="logo" width="150">
                    </div>

                    <!-- Card -->
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Sign up</h1>

                            <div id="error-message" class="text-danger" style="color: #be2937db; padding-bottom: 8px;">
                            </div>

                            <!-- Form -->
                            <form method="POST" class="needs-validation" action="../backEnd/checkSignup.php" id="form"
                                novalidate>

                                <!-- Name & birth date -->
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2 text-muted" for="first_name">Nome*</label>
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                            required>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2 text-muted" for="last_name">Cognome*</label>
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                            required>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2 text-muted" for="birth_date">Data di nascita</label>
                                        <input id="birth_date" type="date" class="form-control" name="birth_date" />
                                    </div>
                                </div>

                                <!-- birth place & sex orient -->


                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-2 text-muted" for="province">Provincia</label>
                                        <select id="province" class="form-select" name="province">
                                            <option value=""></option>
                                            <?php include "../backEnd/getProvinces.php" ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2 text-muted" for="birth_city">Città natale</label>
                                        <select id="birth_city" class="form-select" name="birth_city">
                                            <?php include "../backEnd/getCities.php" ?>
                                        </select>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label class="mb-2 text-muted" for="sex_orient">Orientamento sessuale</label>
                                        <select id="sex_orient" class="form-select" name="sex_orient">
                                            <option selected></option>
                                            <option value="eterosessuale">eterosessuale</option>
                                            <option value="omosessuale">omosessuale</option>
                                            <option value="bisessuale">bisessuale</option>
                                            <option value="altro">altro</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- sensitive data -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mb-2 text-muted" for="email">Email*</label>
                                        <input id="email" type="email" class="form-control" name="email" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-2 text-muted" for="password">Password*</label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>



                                <p class="form-text text-muted mb-3" style="padding-top: 15px;">
                                    By registering you agree with our terms and condition.
                                </p>

                                <div class="align-items-center d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Sign up
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Already have an account? <a href="login.html" class="text-dark">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>