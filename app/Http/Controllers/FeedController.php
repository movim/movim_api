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
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0',
                'Accept'     => 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
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
