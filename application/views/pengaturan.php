<?php $this->load->view('header'); ?>
    <div class="container">

        <div class="col-sm-4"></div>

        <div class="jumbotron">
          <div class="panel panel-default">
            <div class="panel-heading text-center"><strong><h2>PENGATURAN AKUN</h2></strong></div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tr>
                    <td><strong>E-mail</strong></td>
                    <td>:</td>
                    <td>
                      <a href='mailto:<?php echo $user['email']; ?>?subject=feedback'><?php echo $user['email']; ?></a>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Nama User</strong></td>
                    <td>:</td>
                    <td>
                      <?php echo $user['nama_user']; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Username</strong></td>
                    <td>:</td>
                    <td>
                      <?php echo $user['username'] ?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="panel-footer">
              <a href="<?php echo site_url('login/atur_edit') ?>"><button class="btn btn-warning"> <i class="glyphicon glyphicon-cog"></i> Edit Akun</button></a>
            </div>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
<?php $this->load->view('footer'); ?>
