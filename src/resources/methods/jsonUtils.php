<?php
use GuzzleHttp\Client;
require_once __DIR__ . '/../../../config.php';

class jsonUtils
{
    public static function retrieveFeatured()
    {
        // Read the JSON data from the file
        $file = (dirname(__FILE__).'/../../storage/data/featured.json');
        $json_data = file_get_contents($file);

        // Decode the JSON data into a PHP array
        return json_decode($json_data, true);

    }
    public static function generateFeatured()
    {
        $data = self::retrieveFeatured();

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

        $html = '<article class="featured_box">';
        $html .= '<h1 class="fire2">' . $featured_1 . '</h1>';
        $html .= '<img style="image-rendering: pixelated;" src="' . $featured_1_img . '" height="150rem">';
        $html .= '<h3><i class="fa-solid fa-palette"></i> <a href="' . $featured_1_url . '" target="_blank">Template URL</a> (ID: ' . $featured_1_id . ')</h3>';
        $html .= '<h3><i class="fa-solid fa-image"></i> <a href="' . $featured_1_img . '" target="_blank">Image URL</a></h3>';
        $html .= '</article>';
        $html .= '<article class="featured_box">';
        $html .= '<h1 class="fire2">' . $featured_2 . '</h1>';
        $html .= '<img style="image-rendering: pixelated;" src="' . $featured_2_img . '" height="150rem">';
        $html .= '<h3><i class="fa-solid fa-palette"></i> <a href="' . $featured_2_url . '" target="_blank">Template URL</a> (ID: ' . $featured_2_id . ')</h3>';
        $html .= '<h3><i class="fa-solid fa-image"></i> <a href="' . $featured_2_img . '" target="_blank">Image URL</a></h3>';
        $html .= '</article>';
        $html .= '<article class="featured_box">';
        $html .= '<h1 class="fire2">' . $featured_3 . '</h1>';
        $html .= '<img style="image-rendering: pixelated;" src="' . $featured_3_img . '" height="150rem">';
        $html .= '<h3><i class="fa-solid fa-palette"></i> <a href="' . $featured_3_url . '" target="_blank">Template URL</a> (ID: ' . $featured_3_id . ')</h3>';
        $html .= '<h3><i class="fa-solid fa-image"></i> <a href="' . $featured_3_img . '" target="_blank">Image URL</a></h3>';
        $html .= '</article>';

        return $html;
    }
    public static function retrieveData()
    {
        $client = new Client();
        // Read the JSON data from the database
        $response = $client->get(DB_HOST . '/api/collections/templates/records');
        $responseData = json_decode($response->getBody(), true);
        $json_data = $responseData['items'];

        return $json_data;
    }

    public static function generateHTML()
    {
        $articledata = self::retrieveData();
        $article_html = [];

        // Loop through each data point and generate an article for each one
        foreach ($articledata as $article_data) {
            $template_article_title = $article_data['title'];
            $template_article_image = $article_data['image'];
            $template_article_url = $article_data['url'];
            $template_article_content = $article_data['content'];

            // Generate the HTML for the article
            $article_html[] = '<article class="template_box">';
            $article_html[] = '<h2>' . $template_article_title . '</h2>';
            $article_html[] = '<a href="' . $template_article_url . '" target="_blank"><img class="template_article_img" style="image-rendering: pixelated;" src="' . $template_article_image . '" alt="' . $template_article_title . '"></a>';
            $article_html[] = '<h3>' . $template_article_content . '</h3>';
            $article_html[] = '</article>';
        }

        return $article_html;
    }
}
