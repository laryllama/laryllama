<!DOCTYPE html>
<html lang="en">
	<head>
        <title>LaryLlama.com</title>
		<?php include("scripts/google.php"); ?>
		<meta charset="UTF-8">
        <meta name="description" content="Just a random website full of stuff I learned to code.">
        <meta name="keywords" content="laryllama">
        <meta name="author" content="Alex Robinson">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="scripts/index.css">
        <link rel="shortcut icon" href="/images/index/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/images/index/favicon.ico" type="image/x-icon">
		<style>

			body{
				text-align:center;
			}

      a.login{
          font-size: 1vw;
          float: right;
          position: absolute;
          right: 1vw;
          top: 1vw;
      }

			.rootcpimg {
				height: 25vw;
				width: auto;
			}

			/* PAGE LINKS */
			.container{
					display: flex;
					flex-wrap: wrap;
			}

			.item_box{
					margin: auto;
					width: 25%;
			}

			.photo-thumb{
					display: block;
					width: 90%;
					height: auto;
					margin: auto;
					border-radius: 5%;
			}

			.photo-thumb:hover{
					transform: scale(1.05);
			}

			.adsbygoogle {
				margin-left: auto;
				margin-right: auto;
				width: 75%;
				height: auto;
			}

			/* SMALL SCREENS */
			@media screen and (max-width:800px){

					a.login {
							font-size: 5vw;
							right: 5vw;
					}

					.rootcpimg {
						height: 50vw;
					}

					.item_box {
						width: 100%;
					}

					.photo-thumb:hover{
						transform: scale(3);
					}

			}

		</style>
		<?php
    		// Initialize the session
            session_start();
		?>
	</head>
	<body>
		<?php
	        // Check if the user is already logged in, if yes then Change sign up/login
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                echo "<a class='login' href='https://www.laryllama.com/welcome.php'>Account</a>";}
            else
            {echo "<a class='login' href='https://www.laryllama.com/login.php'>Sign Up/Login</a>";}
	    ?>
	    <br>
		<img class="rootcpimg" src="images/index/teacuproo.png" alt="Roo in a Teacup">
		<div class="container">
			<?php

				$json_link="indexlink.js";
				$json = file_get_contents($json_link);
				$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

				foreach ($obj['data'] as $post) {

			    $text=$post['text'];
			    $link=$post['link'];
			    $img=$post['img'];

					echo "<div class='item_box'>";
						echo "<a href='{$link}'>";
	          	echo "<img class='img-responsive photo-thumb' src='{$img}' alt='{$text}'>";
			      echo "</a>";
			    	echo "<p class='text'>";
	          	echo "<div class='caption'>{$text}</div>";
			  		echo "</p>";
					echo "</div>";
				}
			?>
		</div>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Horizontal Image Ads -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9639994701956625"
             data-ad-slot="6903525988"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
      	</script>
				<script async src='https://cse.google.com/cse.js?cx=partner-pub-9639994701956625:1797081064'></script><div class="gcse-searchbox-only"></div>
				<?php
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .= "/scripts/php/footer.php";
					include_once($path);
				?>
	</body>
</html>
