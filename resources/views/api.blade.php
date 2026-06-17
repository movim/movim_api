@extends('layouts.movim', ['title' => 'API & Tools'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">API & Tools</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">

    <ul class="list middle">
        <li>
            <div>
                <p>FeedCleaner</p>
                <p>Before publishing RSS and Atom feeds to a Pubsub node (using a tool like
                    <a href="https://github.com/edhelas/atomtopubsub">AtomToPubsub</a> for example)
                    you need to convert them to a clean and valid <a href="http://www.atomenabled.org/">Atom 1.0 feed</a>.
                </p>

                <p>This tool will do it for you using the <a href="https://github.com/edhelas/feedcleaner">FeedCleaner</a> PHP library.</p>

                <p>This tool is only for test purpose, we advice you to deploy your own feed-cleaner
                    on your server if you need to do several requests per hour with this one.</p>
                <p>We do not guarantee that all the URL will work.</p>
            </div>
        </li>
        <li>
            <span class="primary icon bubble color blue"><i class="material-symbols">rss_feed</i></span>

            <form method="POST" action="{{ route('parse') }}" accept-charset="UTF-8">
                @csrf
                <div>
                    <label for="url">Your feed URL</label>
                    <input class="form-control" placeholder="https://feed.atom" required="" name="url" type="text" id="url">
                </div>

                <input class="button color oppose" type="submit" value="Go">
            </form>
        </li>
    </ul>
</div>
@endsection
