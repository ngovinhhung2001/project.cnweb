<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once 'partials/setting.php';
    require_once 'partials/css.php';
    ?>
</head>

<body style="height: 100%">
    <?php
    require_once 'partials/js.php';
    ?>
    <main class="py-5" style="height: 100%; background-image: url('/img/background.png'); background-repeat: no-repeat; background-size: 1712px;">
        <div class="container py-5" style="height: 100%;">
            <div class="row justify-content-around">
                <div class="col-lg-4 col-sm-6 align-self-center">
                    <div class="card d-flex align-items-center justify-content-center rounded-3 bg-main" style="width: 100%;">
                        <div class="w-50">
                            <a href="/home"><img src="/img/logo.png" class="card-img-top my-4 d-block mx-auto"></a>
                        </div>
                        <div class="card-body w-75">
                            <form action="/register" method="POST">
                                <br>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend input-group-text rounded-start"><i class="fas fa-user"></i></div>
                                    <input id="name" type="text" class="form-control" name="name" value="<?= isset($old['name']) ? $old['name'] : '' ?>" placeholder="Tên người dùng" aria-describedby="nameHelp" required autofocus>

                                    <?php if (isset($errors['name'])) : ?>
                                        <div id="nameHelp" class="form-text col-12"><?= $errors['name'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend input-group-text rounded-start"><i class="fas fa-user"></i></div>
                                    <input id="email" type="email" class="form-control" name="email" value="<?= isset($old['email']) ? $old['email'] : '' ?>" placeholder="Email" aria-describedby="emailHelp" required>

                                    <?php if (isset($errors['email'])) : ?>
                                        <div id="emailHelp" class="form-text col-12"><?= $errors['email'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend input-group-text rounded-start"><i class="fas fa-lock"></i></div>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu" aria-describedby="passwordHelp" required>

                                    <?php if (isset($errors['password'])) : ?>
                                        <div id="passwordHelp" class="form-text col-12"><?= $errors['password'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend input-group-text rounded-start"><i class="fas fa-lock"></i></div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" aria-describedby="confirmpasswordHelp" required>

                                    <?php if (isset($errors['password_confirmation'])) : ?>
                                        <div id="confirmpasswordHelp" class="form-text col-12"><?= $errors['password_confirmation'] ?></div>
                                    <?php endif ?>
                                </div>
                                <div class="input-group">
                                    <p class="m-0" style="margin-right: 0.5rem !important;">Bạn đã có tài khoản?</p>
                                    <a class="text-decoration-none text-reset text-dark-pink" href="/login">Đăng nhập</a>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-outline-pink mb-4 d-block mx-auto">Đăng kí</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    require_once 'partials/js.php';
    ?>
</body>

</html>