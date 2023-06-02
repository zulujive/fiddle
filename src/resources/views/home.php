<?php
include(dirname(__FILE__).'/../../../config.php');

// Read the JSON data from the file
$file = (dirname(__FILE__).'/../../storage/data/featured.json');
$json_data = file_get_contents($file);

// Decode the JSON data into a PHP array
$data = json_decode($json_data, true);

// Set the variables in the script
$featured_1 = $data['featured_1'];
$featured_1_img = $data['featured_1_img'];
$featured_1_url = $data['featured_1_url'];
$featured_1_id = $data['featured_1_id'];
$featured_2 = $data['featured_2'];
$featured_2_img = $data['featured_2_img'];
$featured_2_url = $data['featured_2_url'];
$featured_2_id = $data['featured_2_id'];
$featured_3 = $data['featured_3'];
$featured_3_img = $data['featured_3_img'];
$featured_3_url = $data['featured_3_url'];
$featured_3_id = $data['featured_3_id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Fiddle</title>
    <link rel="stylesheet" type="text/css" href="/style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
  <meta property="og:title" content="PxlsFiddle">
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
    	<h1 style="margin-bottom:0;margin-top:.5rem;font-size:2.5rem;"><i style="color:#de2c09;" class="fa-solid fa-meteor"></i> <b>Pxls</b><a class="fire">Fiddle</a></h1>
    	<small style="margin-top:0;color:var(--text);"><em>pxls.space/#template=</em></small>
    </div>
    <h1 class="titleText" style="opacity:0; margin-bottom:0; margin-left:1rem;animation: fadeIn 0.5s ease .4s forwards;text-shadow: 0 0 1px #fff, 0 0 5px #ff8a00;"><i class="fa-solid fa-fire"></i> Trending</h1>
    <div class="featured">
      <article class="featured_box">
        <h1 class="fire2"><?php echo $featured_1 ?></h1>
        <img style="image-rendering: pixelated;" src="<?php echo $featured_1_img ?>" height="150rem">
        <h3><i class="fa-solid fa-palette"></i> <a href="<?php echo $featured_1_url ?>" target="_blank">Template URL</a> (ID: <?php echo $featured_1_id ?>)</h3>
        <h3><i class="fa-solid fa-image"></i> <a href="<?php echo $featured_1_img ?>" target="_blank">Image URL</a></h3>
      </article>
      <article class="featured_box">
        <h1 class="fire2"><?php echo $featured_2 ?></h1>
        <img style="image-rendering: pixelated;" src="<?php echo $featured_2_img ?>" height="150rem">
        <h3><i class="fa-solid fa-palette"></i> <a href="<?php echo $featured_2_url ?>" target="_blank">Template URL</a> (ID: <?php echo $featured_2_id ?>)</h3>
        <h3><i class="fa-solid fa-image"></i> <a href="<?php echo $featured_2_img ?>" target="_blank">Image URL</a></h3>
      </article>
      <article class="featured_box">
        <h1 class="fire2"><?php echo $featured_3 ?></h1>
        <img style="image-rendering: pixelated;" src="<?php echo $featured_3_img ?>" height="150rem">
        <h3><i class="fa-solid fa-palette"></i> <a href="<?php echo $featured_3_url ?>" target="_blank">Template URL</a> (ID: <?php echo $featured_3_id ?>)</h3>
        <h3><i class="fa-solid fa-image"></i> <a href="<?php echo $featured_3_img ?>" target="_blank">Image URL</a></h3>
      </article>
    </div>
    <hr style="opacity: 0; animation: fadeIn 0.5s ease .9s forwards; border-color: white;">
    <h2 class="titleText" style="opacity: 0; margin-left:1rem; animation: fadeIn 0.5s ease .9s forwards;"><i class="fa-solid fa-brush"></i> Templates</h2>
    <div class="templates">
  <?php
// Read the JSON data from the file
$file = (dirname(__FILE__).'/../../storage/data/articles.json');
$json_data = file_get_contents($file);

// Decode the JSON data into a PHP array
$articledata = json_decode($json_data, true);

// Loop through each data point and generate an article for each one
	foreach ($articledata as $article_data) {
  		$template_article_title = $article_data['title'];
  		$template_article_image = $article_data['image'];
  		$template_article_url = $article_data['url'];
  		$template_article_content = $article_data['content'];

  		// Generate the HTML for the article
  		$article_html = '<article class="template_box">';
  		$article_html .= '<h2>' . $template_article_title . '</h2>';
  		$article_html .= '<a href="' . $template_article_url . '" target="_blank"><img class="template_article_img" style="image-rendering: pixelated;" src="' . $template_article_image . '" alt="' . $template_article_title . '"></a>';
  		$article_html .= '<h3>' . $template_article_content . '</h3>';
  		$article_html .= '</article>';

  		// Output the article HTML
  		echo $article_html;
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