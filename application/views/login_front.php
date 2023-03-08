<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header'); ?>
</head>

<body>
    <div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px" >

        <div class="container">
            <h1>Login</h1>
            <p>Masuk ke Dashboard</p>

            <?php if ($this->session->flashdata('message_login_error')) : ?>
                <div class="invalid-feedback">
                    <?= $this->session->flashdata('message_login_error') ?>
                </div>
            <?php endif ?>

            <form action="" method="post" style="max-width: 600px;">
                <div class="container my-3 justify-content-end">
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" required maxlength="100" placeholder="Email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control " id="password" name="password" required maxlength="100" placeholder="Password">
                        </div>
                        <div class="form-group text-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                        <button type="submit" class="btn btn-warning" style="width: 100%;" value="Login"><small>Lanjutkan</small> <i class="fa-solid fa-right-to-bracket"></i></button>
                    </form>
                </div>

            </form>
        </div>
        <?php $this->load->view('partials/footer.php'); ?>
</body>

</html>