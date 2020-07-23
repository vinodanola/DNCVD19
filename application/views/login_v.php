<div class="content-wrapper content-wrapper-home" >
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-logo">
                        <a href="#"><b>Subsidi Bunga</b></a>
                    </div>
                    <?php if ($signin == 'failed') { ?>
                    <div class="alert alert-danger">
                        <span>Gagal masuk, silahkan coba lagi!</span>
                    </div>
                    <?php }?>
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                      <p class="login-box-msg">Sign in to start your session</p>

                      <form action="<?= base_url().'welcome/signin'; ?>" method="post">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="username" placeholder="Username">
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <input type="password" class="form-control" name="password" placeholder="Password">
                          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>
                    <!-- /.login-box-body -->
                  </div>
            </div>
        </div>
    </section>
</div>


