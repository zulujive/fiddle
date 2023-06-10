<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../methods/jsonUtils.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>FiddleNeo</title>
    <link rel="stylesheet" type="text/css" href="/style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
  <meta property="og:title" content="FiddleNeo">
  <meta property="og:description" content="A collection of templates for Pxls">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
      :root {
        /* Here you can set the colors more easily for the site */
      	--primary: #1a1a1a; /* NAVBAR */
        --secondary: #bf2008; /* BACKGROUND */
        --tertiary: #1a1a1a; /* BOXES */
        --text: #d6d6d6;
        --textSecondary: white;
      }
      body {
        margin: 0;
      	background-color: var(--secondary);
        color: var(--text);
      }
      a {
      	color: var(--text);
      }
      .navbar {
        position: sticky;
        border: 3px solid #bf2008;
        border-top: none;
        border-right: none;
        top: 0;
        z-index: 2;
        margin-right: 0;
        opacity: 0;
      	padding-top: .5rem;
        background-color: var(--primary);
        -webkit-user-select: none; /* Safari */
  		-ms-user-select: none; /* IE 10 and IE 11 */
  		user-select: none; /* Standard syntax */
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        animation: slideDown 0.5s forwards;
      }
      .featured {
      	color: var(--text);
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 0.5rem;
      }
      .featured_box {
        margin: 1rem;
      	text-align: center;
        background-color: var(--tertiary);
        border-radius: 10px;
        padding-bottom: 1rem;
        /*box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.4);*/
        box-shadow: 0 0 2px #fff, 0 0 5px #fff, 0 0 7px #fff, 0 0 10px #ff8a00;
        opacity: 0;
        overflow: hidden;
        animation: slideIn 0.5s forwards;
      }
      .templates {
      	color: var(--text);
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-gap: 1.5rem;
        margin-left: 1rem;
        margin-right: 1rem;
      }
	  .template_box {
        opacity: 0;
  		margin: 0;
  		text-align: center;
  		background-color: var(--tertiary);
  		border-radius: 10px;
  		padding-bottom: 1rem;
        overflow: none;
  		box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.5s ease .9s forwards;
	  }
      .template_article_img {
        height: 9rem;
      	transition: ease .2s;
      }
      article:hover>a>.template_article_img {
      	height: 9.5rem;
      }
      .titleText {
      	color: var(--textSecondary);
      }
      .fa-meteor {
        /*text-shadow: 0 0 2px #fff, 0 0 5px #fff, 0 0 7px #fff, 0 0 10px #ff8a00, 0 0 17px #ff8a00, 0 0 20px #ff8a00, 0 0 25px #ff8a00, 0 0 37px #ff8a00;*/
        background: linear-gradient(to right, #FF4500, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      	animation: floaty-animation 3s ease infinite;
      }
      .fire {
      	background: linear-gradient(to right, #FF4500, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .fire2 {
      	background: linear-gradient(to right, #FF4500, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 67%;
      }
      @keyframes floaty-animation {
  		0% {
    	transform: translateY(0);
  		}
  		50% {
    	transform: translateY(-5px);
  		}
  		100% {
    	transform: translateY(0);
  		}
	  }
	  @keyframes fadeIn {
  		0% { opacity: 0; }
  		100% { opacity: 1; }
	  }
      @keyframes slideIn {
  		0% { transform: translateX(-50px); opacity: 0; }
  		100% { transform: translateX(0); opacity: 1; }
	  }
      .featured_box:nth-child(1) {
  		animation-delay: 0.4s;
	  }

	  .featured_box:nth-child(2) {
  		animation-delay: 0.5s;
	  }

	  .featured_box:nth-child(3) {
  		animation-delay: 0.6s;
	  }
      @keyframes slideDown {
  		0% { transform: translateY(-50px); opacity: 0; }
  		100% { transform: translateY(0); opacity: 1; }
	  }
      @keyframes burnEffect {
      0% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.5); opacity: 1; }
      100% { transform: scale(1); opacity: 0.5; }
    }

    </style>
  </head>
  <body>
    <div class="navbar">
    	<h1 style="margin-bottom:0;margin-top:.5rem;font-size:2.5rem;"><i style="color:#de2c09;" class="fa-solid fa-meteor"></i> <b>Fiddle</b><a class="fire">Neo</a></h1>
    	<small style="margin-top:0;color:var(--text);"><em>pxls.space/#template=</em></small>
    </div>
    <h1 class="titleText" style="opacity:0; margin-bottom:0; margin-left:1rem;animation: fadeIn 0.5s ease .4s forwards;text-shadow: 0 0 1px #fff, 0 0 5px #ff8a00;"><i class="fa-solid fa-fire"></i> Trending</h1>
    <div class="featured">
      <?php 
        $featuredHTML = jsonUtils::generateFeatured();
        echo $featuredHTML;        
      ?>
    </div>
    <hr style="opacity: 0; animation: fadeIn 0.5s ease .9s forwards; border-color: white;">
    <h2 class="titleText" style="opacity: 0; margin-left:1rem; animation: fadeIn 0.5s ease .9s forwards;"><i class="fa-solid fa-brush"></i> Templates</h2>
    <div class="templates">
    <?php
      $articleHTML = jsonUtils::generateHTML();

      // Iterate over the $articleHTML array and output the HTML
      foreach ($articleHTML as $html) {
          echo $html;
      }
    ?>

    </div>
    <div class="footer">
    <p style="margin-bottom:.5rem; color: white;">
      Made with <i class="fa fa-heart" aria-hidden="true"></i> in <i class="fa-brands fa-php fa-2xl"></i>
    </p>
  	</div>
  </body>
</html>