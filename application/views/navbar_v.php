<header class="main-header">
    <nav class="navbar navbar-static-top my-navbar">
      <div class="container">
        <div class="navbar-header">
          <a href="<?= base_url(); ?>"  class="navbar-brand">
              <b>PNM</b>
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= base_url(); ?>" class="no-border"><?= $this->session->signin['NAMA']; ?></a>
                </li>
                <?php if ( in_array('M1',$this->session->signin['MENU']) ) { ?>
                    <li class="dropdown">
                        <a class="no-border dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Subsidi Bunga
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header text-aqua">
                                Mekaar
                            </li>
                            <li>
                                <a href="<?= base_url() .'Subsidibungamekaar/'; ?>">Daftar Kelompok</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?= base_url().'Welcome/signout'; ?>" class="no-border">Logout</a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
  </header>

