<?php include 'test.php'; ?>

<!doctype html>
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>TEST</title>
  <meta name="description" content="">

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/completepagination.css">

</head>
<body>
  <header>
      <h1>Hash Functions and Keeping Passwords Safe</h1>
  </header>
  <div id="lefty" role="main">
    <form id="form" action="processForm.php" autocomplete="on" method="post">
        <ul>  
            <li><label for="name">Name: </label><input class="" type="text" name="name" /></li>  
            <li><label for="name">First Name: </label><input class="" type="text" name="firstName" /></li>
            <li><label for="name">Last Name: </label><input class="" type="text" name="lastName" /></li>
            <li><label for="name">Username: </label><input class="required" type="text" id="username" name="username" /><span id="loader"></span><span id="message"></span></li>  
            <li><label for="name">Password: </label><input class="required" type="text" name="password" /></li>
            <li>Save <input type="checkbox" name="save" value="0" ></li>
            <li><input type="submit" /></li>
        </ul>
     </form>
  </div>
    <div id="righty">
        <?php echo $pagination_html; ?>
        <form method="post" action="">
            Country Name: <input type="text" name="txt_name" value="<?php echo @$_REQUEST['txt_name'];?>" />
            <input type="submit" value="Submit" />            
        </form>
        <table border="1" cellpadding="2" cellspacing="2">
            <thead>
            <tr>
                <th>Country</th>
                <th>Country Abb</th>
                <th>Currency Abb</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while($record = mysql_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $record['Country'];?></td>
                    <td><?php echo $record['CountryAbbrev'];?></td>
                    <td><?php echo $record['CurrencyAbbr'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $pagination_html2;?>
        </div>
  <!--<footer>
      <h1>example ends</h1>
  </footer>-->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
  <script src="js/projectName.js"></script>

</body>
</html>