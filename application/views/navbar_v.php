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
                
                <?php if ( in_array('M1',$this->session->signin['MENU']) ) { ?>
                    <li>
                        <a href="<?= base_url(); ?>" class="no-border">Dashboard</a>
                    </li>
                    <li class="dropdown">
                        <a class="no-border dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Realisasi
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
<!--                            <li class="dropdown-header text-aqua">
                                Mekaar
                            </li>-->
                            <li>
                                <a href="<?= base_url() .'Subsidibungamekaar/per_kelompok'; ?>">Nasabah Belum Lunas - Per Kelompok</a>
                            </li>
                            <li>
                                <a href="<?= base_url() .'Subsidibungamekaar/per_nasabah'; ?>">Nasabah Belum Lunas - Per Nasabah</a>
                            </li>
                            <li>
                                <a href="<?= base_url() .'Sbmkrlunas/'; ?>">Nasabah Lunas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="no-border dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Report
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= base_url() .'Report/saldo_detail'; ?>">Saldo</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ( in_array('M2',$this->session->signin['MENU']) ) { ?>
                    <li>
                        <a href="<?= base_url(); ?>" class="no-border">Home</a>
                    </li>
                    <li class="dropdown">
                        <a class="no-border dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            Bansos
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= base_url() .'Bansos/per_nasabah'; ?>">Daftar Nasabah</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#" class="no-border"><?= $this->session->signin['NAMA']; ?></a>
            </li>
            <li>
                <a href="<?= base_url().'Welcome/signout'; ?>" class="no-border">Log out</a>
            </li>
        </ul>
      </div>
    </nav>
  </header>

