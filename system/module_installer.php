	<head>
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	    <style>
	      body {
	        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	      }
	     </style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
		  $("a").click(function(){
		   $.ajax({
		   type: "POST", 
		   url: "../modules/users/index.php", // url du fichier php
		   success: function(msg){ // si l'appel a bien fonctionné
				console.log(msg);
				if(msg==1) // si la connexion en php a fonctionnée
				{
					$("div#test").html("<span id=\"confirmMsg\">Vous &ecirc;tes maintenant connect&eacute;.</span>");
				}
				else // si la connexion en php n'a pas fonctionnée
				{
					$("span#test").html("<img src=\"bomb.png\" style=\"float:left;\" />&nbsp;Erreur lors de la connexion, veuillez v&eacute;rifier votre login et votre mot de passe.");
					// on affiche un message d'erreur dans le span prévu à cet effet
				}
		   }
		});
		return false; // permet de rester sur la même page à la soumission du formulaire
		  });
		});
		</script>
	</head>
	<body>
	  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Florence ORM</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="../index.php">Home</a></li>
              <li class="active"><a href="#">Module Pooler</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <?php



if ($handle = opendir('../modules')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $dir =  readdir($handle);
            // echo "Install <a id='test' href='../modules/".$dir."'> ".$dir."</a>";
            echo "Install <a id='test' href=#> ".$dir."</a>";

        }
    }
    closedir($handle);
}

?>
<div id="test"></div>
    </div> <!-- /container -->
	</body>
