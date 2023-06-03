<?php

class jsonUtils
{
    public function retrieveTemplates()
    {
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
    }
}