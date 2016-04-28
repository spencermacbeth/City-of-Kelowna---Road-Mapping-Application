<!-- added by spencerm -->
<?php
    session_start();
    //make connection to database
    $mysqli = mysqli_connect("cosc304.ok.ubc.ca", "mjoseph", "15057136", "db_mjoseph");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    else {
        //map the csv uploaded by the user to an array
        $csv= array_map('str_getcsv', file($_FILES["csvfile"]["tmp_name"]));

        //instantiate the table and attribute variables for create table
        $tableName = $_POST["tableName"];
        $_SESSION["table"] = $tableName;
        $tableAttributes = array();

        foreach($csv[0] as $attr) {
            $tableAttributes[] = $attr;
        }

        //Execute a create table statement
        $sql = "create table $tableName (";

        foreach($tableAttributes as $attr) {
            if($attr != "")
                $sql = $sql.$attr." varchar(255), ";
            }

         $sql = substr($sql, 0, strlen($sql) - 2).");";
         $res = mysqli_query($mysqli, $sql);

         if ($res === TRUE) {
         }
         else {
             $create = $create." Could not create table: ".strval(mysqli_error($mysqli));
         }

        //Generate the sql for all the inserts necesarry to input entire csv
        $inserts = array();
        $sql = "insert into $tableName values('";

        $headerSkipped = false;
        foreach($csv as $tuple) {
            if($headerSkipped == true) {
                foreach($tuple as $attr) {
                    $sql = $sql.$attr."', '";
                }

                $sql = substr($sql, 0, strlen($sql) - 3).");";
                $create = $create." ".$sql;
                $inserts[] = $sql;
            }

            $headerSkipped = true;
            $sql = "insert into $tableName values('";
        }

        //Execute all the insert statements generated
        foreach($inserts as $insert) {
            $res = mysqli_query($mysqli, $insert);

            if ($res === TRUE) {
            }
            else {
               $display = "Could not insert into table: ".strval(mysqli_error($mysqli));
            }
        }

        //Query for testing
        $sql = "SELECT * FROM $tableName";
        $res = mysqli_query($mysqli, $sql);
        if ($res) {
            $number_of_rows = mysqli_num_rows($res);
            printf("Result set has %d rows.\n", $number_of_rows);
        }
        else {
            $display = "Could not retrieve records: ".strval(mysqli_error($mysqli));
        }

        //Update the index.php file to contain a button to layer the newly inserted
        //content on the map. Done by overwriting the contents of the index.php file
        //after updating the block containing the buttons to add layers.
        $target = '<button class="btn col-xs-12 get-checked-data" id="snow" onclick="setLayer(\'snow\')">Snow Plow Routes</button>';
        $newButton = '<button class=\'btn col-xs-12 get-checked-data\' onclick=\'setLayer("'.$tableName.'")\'>'.$tableName.'.csv layer</button>';
        $io = fopen('index2.php', 'r+');
        $file = file_get_contents('index2.php');

        $file = str_replace($target, $newButton, $file);
        fwrite($io, $file);

        $display = 'File successully uploaded. <br>See homepage for updates.<br><br><a href="index2.php" class="btn btn-info" role="button">View Homepage</a><br>';

        }
     ?>

<?php include '../application/views/header.php';?>

<body>

  <div id="wrapper">

  <div id="main">
          <section>
              <div class="container">
       <div id="inputs">
        <div class="col-md-12">
            <div class="panel panel-default panel-info">
                <div class="panel-heading"><h3 class="panel title">Result:</h3></div>
                <div class="panel-body">
                    <h3><b><?php echo $display; ?></b></h3>
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
