@extends('layouts.app')

@section('title', 'Home')

@section('content')
<p>The Movim API provides a RESTful API to manage data of the Movim network. This API will answer you using JSON.</p>

<h2>Pods</h2>

<h3>List</h3>

<p>You can list all the enabled pod reaching the following URL :</p>
<pre><a href="{{ action('PodsController@index') }}">{{ action('PodsController@index') }}</a></pre>

<p>You can also get the information of one pod by adding his ID :</p>
<pre><a href="{{ action('PodsController@show', 1) }}">{{ action('PodsController@show', 1) }}</a></pre>

<p>You can also get the favorite pods of the Movim team by requesting :</p>
<pre><a href="{{ action('PodsController@favorite') }}">{{ action('PodsController@favorite') }}</a></pre>

<h3>Register</h3>

<p>If you own a Movim pod you can easily register by sending a POST request on <code>/register</code></p>

<h4>Registration validation</h4>

<p>To prevent spam and fake pods the API and the moderation team will perform several verification steps.</p>

<ol>
    <li>When you call <code>http://api.movim.eu/pods/register</code> you need to send a parameter with your POST request :</li>
    <ul>
        <li><code>url</code> which contain the root URL of your Movim pod.</li>
    </ul>
    <li>We will check if a pod is already registered.</li>
    <li>The API will check if the URL is available and will try to get
    informations on your pod by requesting <code>/?infos</code></li>
    <li>Then we will verifiy if you reach the limit of 3 pods registered
    per domain. <strong>This limit is only here to prevent spamming.</strong></li>
    <li>Finally a moderator will check your pod and enable it if all is ok :)</li>
</ol>

<h2>FeedCleaner</h2>

<p>Before publishing RSS and Atom feeds to a Pubsub node (using a tool like
<a href="https://github.com/edhelas/atomtopubsub">AtomToPubsub</a> for example)
you need to convert them to a clean and valid <a href="http://www.atomenabled.org/">Atom 1.0 feed</a>.</p>

<p>This tool will do it for you using the <a href="https://github.com/edhelas/feedcleaner">FeedCleaner</a>
PHP library.</p>

<p>This tool is only for test purpose, we advice you to deploy your own feed-cleaner
on your server if you need to do several requests per hour with this one.</p>

<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(['method' => 'POST', 'action' => ['FeedController@parse']]) }}
            <div class="form-group">
                {{ Form::label('url', 'Your feed URL') }}
                {{ Form::text('url', null, ['class'=>'form-control']) }}
            </div>

            {{ Form::submit('Go', array('class'=>'btn btn-success pull-right')) }}

            <span class="help-block">We do not guarantee that all the URL will work.</span>
        {{ Form::close() }}
    </div>
</div>
@endsection

