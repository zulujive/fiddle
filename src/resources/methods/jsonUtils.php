<?php
use GuzzleHttp\Client;

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

    // Retrieve data about the featured templates and put them in an array
    public static function instFeatured()
    {
        $data = self::retrieveFeatured();
        $featuredImages = array();

        foreach ($data as $ftData) {
            $ftId = $ftData['id'];
            $ftDb = PocketBase::imgById($ftId);

            $imgInfo = array(
                'id' => $ftId,
                'data' => $ftDb
            );

            $featuredImages[] = $imgInfo;
        }

        return $featuredImages;
    }

    public static function generateFeatured()
    {
        $instImgs = self::instFeatured();
        $html = [];

        foreach ($instImgs as $img) {
            $data = $img['data'];
            $title = $data["title"];
            $url = $data["url"];
            $id = $data["id"];
            $img = '/templates/' . $id;

            $html[] = '<article class="featured_box">';
            $html[] = '<h1 class="fire2">' . $title . '</h1>';
            $html[] = '<img style="image-rendering: pixelated;" src="' . $img . '" height="150rem">';
            $html[] = '<h3><i class="fa-solid fa-palette"></i> <a href="' . $url . '" target="_blank">Template URL</a> (ID: ' . $id . ')</h3>';
            $html[] = '<h3><i class="fa-solid fa-image"></i> <a href="' . $img . '" target="_blank">Image URL</a></h3>';
            $html[] = '</article>';
        }

        return $html;
    }

    public static function retrieveData()
    {
        $client = new Client();
        // Read the JSON data from the database
        $response = $client->get(config('DB_HOST') . '/api/collections/templates/records', [
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ]);
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
            $template_article_id = $article_data['id'];
            $template_article_title = $article_data['title'];
            $template_article_image = '/templates/' . $template_article_id;
            $template_article_url = $article_data['url'];

            // Generate the HTML for the article
            $article_html[] = '<article class="template_box">';
            $article_html[] = '<h2>' . $template_article_title . '</h2>';
            $article_html[] = '<a href="' . $template_article_url . '" target="_blank"><img class="template_article_img" style="image-rendering: pixelated;" src="' . $template_article_image . '" alt="' . $template_article_title . '"></a>';
            $article_html[] = '</article>';
        }

        return $article_html;
    }
}
