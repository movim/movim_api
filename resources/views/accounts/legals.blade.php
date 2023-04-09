@extends('layouts.movim', ['section_class' => 'large'])

@section('content')

<header>
    <ul class="list middle">
        <li>
            <div>
                <p class="center">Legal disclaimer</p>
                <p class="center">Updated on Thursday 30th of December 2021</p>
            </div>
        </li>
    </ul>
</header>

<div class="block container">

<article>
    <section class="large">
        <content>
    <p>This is the legal disclaimer document that applies to the Movim services. <br /><b>In order to use our services, you must approve this document.</b>
    </p>
    <p>This document defines the end-user responsibilities and our obligations about your data.</p>
    <p><em>Our services</em> is used to designate the following services:</p>

    <h4>Hosted in Germany at <a href="https://www.netcup.eu/">netcup GmbH</a></h4>
    <ul>
        <li>The movim.eu and jappix.com XMPP service and related services</li>
        <li>The mov.im Movim instance</li>
    </ul>

    <h4>Hosted in France on a personal self-hosted server</h4>
    <ul>
        <li>The XMPP services and Movim instance database backups</li>
    </ul>

    <p>Both services are operated by us since the 16 August 2017.</p>

    <p><em>We</em>, <em>us</em> or <em>The Movim team</em> is designating:</p>

    <ul>
        <li>Timothée Jaussoin - Administrator of the services and maintainer of Movim</li>
    </ul>

    <h1>About</h1>

    <p>All our services are offered for free.</p>
    <p>We are hosting Libre and Open Source Software and offer non-commercial alternative solutions to centralized, commercial, messaging and social platforms.</p>

    <h1 id="laws">Laws</h1>

    <p>Our services are stored in Germany and France. For the correspondig data hosted in each country, the French and German juridiction applies.</p>
    <p>All our services are hosted in the European Union, therefore the <a href="https://en.wikipedia.org/wiki/General_Data_Protection_Regulation">GDPR</a> applies to all the data we are managing.</p>

    <h1 id="privacy_policy">Privacy Policy</h1>

    <h2 id="data_policy">What we store</h2>

    <p>For movim.eu and jappix.com XMPP accounts:</p>
    <ul>
        <li>Your username, a hash of your password and related data (vcard, profile picture)</li>
        <li>Your email, if provided, to allow you to recover your password</li>
        <li><b>Articles</b> All the articles and comments published by you on our services</li>
        <li><b>Messages</b> All the messages sent to and from your contacts, or from the chatrooms you are connected to. You can configure message storage using the Movim configuration panel.</li>
        <li><b>Files</b> All the pictures and files uploaded using your account.</li>
        <li><b>Contacts</b> Your contact list (XMPP Roster)</li>
        <li>All the data published by Movim or other XMPP clients you are using on your XMPP account (OMEMO public keys, bookmarks.)</li>
    </ul>
    <p>All the data above are stored as long as we can on our services until you destroy your account, see <a href="#withdrawal">Withdrawal</a>.</p>

    <p>For XMPP accounts using our mov.im public Movim instance:</p>
    <ul>
        <li>Your username, an encrypted version of your password (the key is sent back to your browser, this allow Movim to quickly log-you back in)</li>
        <li><b>Articles</b> A cache of all the articles published by you on our services and other XMPP services you accessed</li>
        <li><b>Messages</b> A cache of the messages published and received by you or your contacts or from the chatrooms you are connected to</li>
        <li><b>Files</b> A cache of the pictures accessed using your account</li>
        <li><b>Contacts</b> Your contact list (XMPP Roster)</li>
        <li>A cache of all the data published by Movim or other XMPP clients you are using on your XMPP account (OMEMO public keys, bookmarks.)</li>
    </ul>

    <p>All the data above are stored as long as we can on our services. Using the Movim configuration panel you can choose to leave the instance. If you do so, all the data related to your XMPP account will be destroyed.</p>

    <p>To operate our services we are also storing some amount of logs and related data, those logs are rotated daily and destroyed using the following rules:</p>

    <ul>
        <li>ejabberd (our XMPP server): 14 days, errors and general info (failed connections, security errors)</li>
        <li>nginx (our Web server): 14 days, errors and pages accessed (containing your IP and browser User-Agent)</li>
        <li>A global backup of our main databases (XMPP and Movim) is done daily on a local self-hosted server in France. This backup is refreshed each night and is only used for restoration purposes</li>
    </ul>

    <h2 id="data_policy">Limits</h2>

    <p>Some limits also apply to our services:</p>

    <ul>
        <li><b>File Upload</b> is limited to 10MB per file. There is no other limit (total volume or time) regarding the storage of those files</li>
        <li><b>XMPP and HTTP connections</b> we have some connection limitations in place, both on our XMPP services and web services to limit the bandwidth and amount of requests per user</li>
        <li><b>XMPP registration</b> also known as "In-band registration" is disabled on our services. To register an account you must use our <a href="{{ route('accounts.register') }}">Registration page</a></li>
    </ul>

    <h1 id="terms_conditions">Terms and Conditions</h2>

    <h2 id="terms">1. Our terms</h2>

    <p>By using our services, you approve to the following terms. If you do not, please remove your account and all the content you shared and stop using our services.</p>

    <p>We give ourself the right to remove all the data that does not comply with the sections bellow or transfer them to the authorities if required.</p>

    <h3>1.1. Be responsible of your acts</h3>
    <p>You are responsible of everything you do on our services. This includes your messages to others, the chatrooms you create, the files you share...</p>
    <p>Chat rooms and Movim Communities owners are responsible of the ideas and the content their users share. This is their job to name moderators to keep control on what is done there.</p>
    <p>In the end we are always free to moderate and/or remove any content or accounts that we don't feel appropriate from the platform.</p>

    <h3>1.2. Do not degradate others</h3>
    <p>Degradating or injuring someone on our services is forbidden, please be kind to eachothers.</p>
    <p>You, as a user, are the only responsible person of what you say on our platform, as well as others are responsible from their speech</p>

    <h3>1.3. Do not try to alter the service</h3>
    <p>Our service was designed to handle random but stable loads. Please do not try to alter it by trying to hack into it using known vulnerabilities or 0-days or launching a DDoS attack on it.</p>

    <p>If you find a security issue in one of our service. Please report it to us using our <a href="https://github.com/movim/movim/blob/master/SECURITY.md">Security Policy</a>.

    <h3>1.4. Do not post content you don't own</h3>
    <p>Please respect the copyright on the content you post on our platform, coming from someone else.</p>
    <p>You can post content for which your have permission, whether it is your own work and you possess the copyright, or your have permission from the author to use it.</p>

    <h3>1.5. Do not post injurious, racist, libelous or pedophile content</h3>
    <p>Such behavior is punished by the law. You, as a citizen, is responsible of what you say on the service.</p>

    <h3>1.6. Do not use our service for profits</h3>
    <p>You are not allowed to take profits from our service, by selling user accounts for instance. Usage of our service must remain non-profit (it can be used in companies, but no money can be done via our service).</p>

    <h3>1.7. Do not try to hack accounts</h3>
    <p>Respect others, do not try to get their password or personal information by any official uses.</p>

    <h2>2. Your rights</h2>

    <p>Our services are hosted in the European Union, therefore the GDPR applies to all the data we manage linked to your account or activities.</p>

    <p>You can therefore ask us to:</p>

    <h3>2.1. Remove content concerning you</h3>
    <p>This includes your account and related contents and your files stored on our system.</p>
    <p>You can also ask us to remove any content concerning you that is owned by another user on our platform.</p>

    <h3>2.2. Getting content concerning you</h3>
    <p>You can ask us to get a copy of all the content we store concerning you. To do that you can directly contact us using the contacts information provided on the Help page on Movim.</p>

    <h2>3. No Warranty</h2>

    <p>You understand and agree that our services are offered as is, subject to availability and without liability to you. As much as we would not like to let any of our users down, we just can not give any warranty as to the reliability, accessibility, or quality of our services.</p>

    <p>You agree that the use of our services is at your sole and exclusive risk.</p>

    <h2 id="withdrawal">4. Withdrawal</h2>

    <p>This document may be updated at any time. Users shall be notified of any modification 4 weeks ahead of time. By continuing using our services after the date of publishing, we will consider you have agreed to the new conditions.</p>
    <p>You own the right to retract yourself from our service if you don't agree to this document.</p>
    <p>In this case, you will need to:</p>
    <ol>
        <li>Stop using the service</li>
        <li>Remove all your accounts on our service</li>
        <li>Remove all your data on our service</li>
    </ol>

    <p>You can destroy your account and all the related data using the Movim configuration panel, Account tab, "Delete your Account" button. We might keep some account related data for some times regarding our <a href="#privacy_policy">Privacy Policy</a>.</p>
        </content>
    </section>
</article>

<ul class="list thick">
    <li>
        <div>
            <p class="center">The Movim team</p>
            <p class="center">Contact us on <a href="xmpp:movim@conference.movim.eu?join">our conference room</a></p>
        </div>
    </li>
</ul>

</div>

@endsection
