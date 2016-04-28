<!-- added by spencerM -->

<?php include '../application/views/header.php';  session_start();?>

  <body>
    <div id="wrapper">
      <div id="main">
        <div id="content">
          <section id="firstBlurb">
            <div class="container">
              <br>
              <br>
              <h1>Current Road Conditions: Kelowna</h1>
              <p>Use the filters below to toggle different layers on the map. Longer time range queries will take longer to appear.</p>
            </div>
          </section>
          <section class="color">
            <div class="container" style="margin-top:20px;">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <h3 class="text-center" style="color:white">Select a Filter Below:</h3>
                  <br>
                  <div class="well" style="max-height: 800px; overflow: auto; margin:0 auto;" id="sideContent">
                    <br>
                    <button class="btn col-xs-12 get-checked-data" id="snow" onclick="setLayer('snow')">Snow Plow Routes</button>
                    <div class="timeFilters" style="text-align: center; display: none;">
                      <div class="row" style="color: red">
                        Please select a time range:
                      </div>
                      <button type="button" id="10" name="past10" class="btn btn-success" onclick="timeQuery(10)">Past 10 Minutes</button>
                      <button type="button" id="30" name="past30" class="btn btn-success" onclick="timeQuery(30)">Past 30 Minutes</button>
                      <button type="button" id="60" name="past60" class="btn btn-success" onclick="timeQuery(60)">Past 1 Hour</button>
                      <button class="btn btn-danger col-xs-12" id="clear" onclick="clearMap()">Clear Map</button>
                    </div>
                    <!-- the weather widget app -->
                    <span style="display: block !important; text-align: center; font-family: sans-serif; font-size: 12px; margin: 20px auto 0 auto;" id="widgetCont"><a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:00000.1.71203&bannertypeclick=wu_clean2day" title="Kelowna, British Columbia Weather Forecast" target="_blank"><img src="http://weathersticker.wunderground.com/weathersticker/cgi-bin/banner/ban/wxBanner?bannertype=wu_clean2day_metric_cond&airportcode=CYLW&ForcedCity=Kelowna&ForcedState=Canada&wmo=71203&language=EN" alt="Find more about Weather in Kelowna, CA" id="weatherWidget" /></a><br><a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:00000.1.71203&bannertypeclick=wu_clean2day" title="Get latest Weather Forecast updates" style="font-family: sans-serif; font-size: 12px; color: #000;" target="_blank">Click for weather forecast</a></span>
                  </div>
                  <pre id="display-json"></pre>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8" id="navigate">
                  <h3 class="text-center" style="color:white" id="navTxt">Navigate the Google Map:</h3>
                  <br>
                  <div id="map" class="basic"></div>
                </div>
              </div>
              <!-- row -->
            </div>
            <!-- container -->
          </section>
          <section id="notesBlurb">
            <div class="container">
              <h1>Notes:</h1>
              <li>Filters may only be viewed one at a time. For example, it is not possible to select both the traffic and the bike route layers concurrently.</li>
              <li>Snowplow cleared roads are updated every 10 minutes, or as the data becomes available.</li>
            </div>
          </section>
        </div>
        <!-- #content -->
      </div>
      <!-- #main -->
    </div>
    <!-- /#wrapper -->
<script src="js/mapFunc.js"></script>
    <?php include '../application/views/footer.php';?>

  </body>
 </body>
