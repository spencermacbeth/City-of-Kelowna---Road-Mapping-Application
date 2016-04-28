<!-- added by spencerm -->
<?php include '../application/views/header.php';?>
<body>
  <div id="wrapper">
  <div id="main">

          <section>
              <div class="container">
       <div id="inputs">
        <div class="col-md-12">
            <div class="panel panel-default panel-info">
                <div class="panel-heading"><h3 class="panel title">Please enter your credentials:</h3></div>
                <div class="panel-body">
                  <div class="row">
                      <form action="admin_login.php" method="POST">
                  <div class="col-md-1">
                      <p>Username</p>
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="username">
                  </div>
                  </div>
                    <div class="row">
                  <div class="col-md-1">
                      <p>Password</p>
                  </div>
                  <div class="col-md-4">
                    <input type="password" name="password">
                  </div>
                    </div>
                 <div class="row">
                  <div class="col-md-8">
                    <input type="submit" value="Login">
                  </div>
                  </div>
                </div>
            </div>
        </div>
              </form>
          </div>
      </div>

              </div>
          </section>

  </div><!-- #main -->


  </div><!-- /#wrapper -->
  <?php include("../application/views/footer.php");?>
</body>
</html>
