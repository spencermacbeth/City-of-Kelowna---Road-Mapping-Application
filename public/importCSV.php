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
                <div class="panel-heading"><h3 class="panel title">Select a CSV file to upload:</h3></div>
                <div class="panel-body">
                <form action='uploadData.php' method='POST' enctype='multipart/form-data'>
                    <br><div class="col-md-4 col-md-push-4"><input type='file' name='csvfile'></div></div><br>
                    Enter a name for a table in the database:<br><input type='text' name='tableName'><br>
                    <input style="margin-top: 3px;" type='submit' value='upload'>
                </form>
                </div>
            </div>
        </div>
          </div>
          </section>

  </div><!-- #main -->


  </div><!-- /#wrapper -->
  <?php include("../application/views/footer.php");?>
</body>
</html>
