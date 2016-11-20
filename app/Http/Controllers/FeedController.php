<?php

namespace App\Http\Controllers;

use FeedCleaner\Parser;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function parse(Request $request)
    {
        $all = $request->all();

        return redirect('feed/'.str_replace('/', '_', base64_encode((string)$all['url'])));
    }

    public function show($url)
    {
        $url = base64_decode(str_replace('_', '/', $url));

        $parser = new Parser;

        $response = \Guzzle::get($url, [
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
            ]
        ]);

        $parser->setXML($response->getBody()->getContents());
        $parser->parse();

        // Reddit hack
        if(strpos($url, 'reddit.com') !== false) {
            $parser->transform('reddit');
        }

        $parser->generate();
    }
}
