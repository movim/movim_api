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

<div class="card shadow">
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

    <h4>Hosted in France on a personnal self-hosted server</h4>
    <ul>
        <li>The XMPP services and Movim instance database backups</li>
    </ul>

    <h1>About</h1>

    <p>All our services are offered for free.</p>
    <p>We are hosting them to the Libre and Open Source Softwares movement and to offer non-commercial alternative solutions to the centralized and commercial messaging and social platforms.</p>

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
        <li><b>Messages</b> All the messages published and received by you or your contacts or from the chatrooms you are connected on. You can configure messages storage using the Movim configuration panel.</li>
        <li><b>Files</b> All the pictures and files uploaded using your account.</li>
        <li><b>Contacts</b> Your contact list (XMPP Roster)</li>
        <li>All the data published by Movim or other XMPP clients you are using on your XMPP account (OMEMO public keys, bookmarks.)</li>
    </ul>

    <p>All the data above are store indefinitely on our services until you destroy your account, see <a href="#withdrawal">Withdrawal</a>.</p>

    <p>For XMPP accounts using our mov.im public Movim instance:</p>
    <ul>
        <li>Your username, an encrypted version of your password (the key is sent back to your browser, this allow Movim to quickly log-you back in)</li>
        <li><b>Articles</b> A cache of all the articles published by you on our services and other XMPP services you accessed</li>
        <li><b>Messages</b> A cache of the messages published and received by you or your contacts or from the chatrooms you are connected on</li>
        <li><b>Files</b> A cache of the pictures accessed using your account</li>
        <li><b>Contacts</b> Your contact list (XMPP Roster)</li>
        <li>A cache of all the data published by Movim or other XMPP clients you are using on your XMPP account (OMEMO public keys, bookmarks.)</li>
    </ul>

    <p>All the data above are stored indefinitely on our services. Using the Movim configuration panel you can choose to leave the instance. If you do so, all your XMPP account related data (including non-shared cache) will be destroyed.</p>

    <p>To operate our services we are also storing some logs and related data, those logs are rotated daily and destroyed using the following rules:</p>

    <ul>
        <li>ejabberd (our XMPP server): 14 days, errors and general info (failed connections, security errors)</li>
        <li>nginx (our Web server): 14 days, errors and pages accessed (containing your IP and browser User-Agent)</li>
        <li>A global backup of our main databases (XMPP and Movim) is done daily on a local self-hosted server in France. This backup is refreshed each night and is only used for restoration purpose</li>
    </ul>

    <h2 id="data_policy">Limits</h2>

    <p>Some limits are also applied to our services:</p>

    <ul>
        <li><b>File Upload</b> are limited to 10Mo per file. There is no other limit (total volume or time) regarding the storage of those files</li>
        <li><b>XMPP and HTTP connections</b> we have some connections limitations in place, both on our XMPP services and web services to limit the bandwith and amount of requests per user</li>
    </ul>

    <h1 id="terms_conditions">Terms and Conditions</h2>

    <h2 id="terms">1. Our terms</h2>

    <p>By using our services, you approve to the following terms. If you do not, please remove your account and all the content you shared and stop using our services.</p>

    <p>We are also giving ourself the right to remove all the data that are not complying with the sections bellow or transfer them to the authorities if required.</p>

    <h3>1.1. Be responsible of your acts</h3>
    <p>You are legally responsible of everything you do on our services. This includes your messages to others, the chatrooms you create, the files you share...</p>
    <p>Chat rooms and Movim Communities owners are responsible of the ideas and the content their users share. This is their job to name moderators to keep control on what is done there.</p>
    <p>We are not responsible of your commitments. Every legal problem concerning content you shared will be assigned to you and not Movim, the owner of the service, nor netcup GMbH, our server providers.</p>

    <h3>1.2. Do not degradate others</h3>
    <p>Degradating someone by altering his identity or injuring him is illegal.</p>
    <p>You, as an user, is the only responsible person of what you say on our platform, as well as others are responsible from their speeches.</p>

    <h3>1.3. Do not try to alter the service</h3>
    <p>Our service was designed to handle random but stable loads. Please do not try to alter it by trying to hack it, get into a security hole or launching a DDoS attack on it.</p>

    <p>If you find a security issue in one of our service. Please report it to us using our <a href="https://github.com/movim/movim/blob/master/SECURITY.md">Security Policy</a>.

    <h3>1.4. Do not post content you don't own</h3>
    <p>Please respect the copyright on the content you may want to post on our platform, coming from someone else.</p>
    <p>You can post content that is your work, or licensed under a free license.</p>

    <h3>1.5. Do not post injurious, racist, libelous or pedophile content</h3>
    <p>Such behavior is punished by the law. You, as a citizen, is responsible of what you say on the service.</p>

    <h3>1.6. Do not use our service for profits</h3>
    <p>You are not allowed to take profits from our service, by selling user accounts for instance. Usage of our service must remain non-profit (it can be used in companies, but no money can be done via our service).</p>

    <h3>1.7. Do not try to hack accounts</h3>
    <p>Respect others, do not try to get their password or personnal information by any official uses.</p>

    <h3>1.8. Do not steal someone else's brand or name</h3>
    <p>When a brand does not belong to you, you're not allowed to use the same name for your username or chatroom name on our network. That's the same for people's identity. You're not allowed to take the identity of somebody else.</p>

    <h2>2. Your rights</h2>

    <p>Our services are hosted in the European Union, therefore the GDPR applies to all the data we manage linked to your account or activities.</p>

    <p>You can therefore ask us to:</p>

    <h3>2.1. Remove content concerning you</h3>
    <p>This includes your account and related contents and your files stored on our system.</p>
    <p>You can also ask us to remove any content concerning you that is owned by another user on our platform.</p>

    <h3>2.2. Getting content concerning you</h3>
    <p>You can ask us to get a copy of all the content we store concerning you.</p>

    <h3>2.3. Getting data about other parties to resolve a legal issue</h3>
    <p>In order to resolve a legal issue between you and another user of the platform, you are allowed to ask us for the contact information of an user (this includes email address, phone number, postal address or IP address).</p>
    <p>We won't share data concerning somebody to anyone, you will need to prove your identity before, and only request contact data or data which can prove something useful in the issue resolution.</p>

    <h2>3. No Warranty</h2>

    <p>You understand and agree that our services are offered as is, subject to availability and without liability to you. As much as we would not like to let any of our users down, we just can not give any warranty as to the reliability, accessibility, or quality of our services.</p>

    <p>You agree that the use of our services is at your sole and exclusive risk.</p>

    <h2 id="withdrawal">4. Withdrawal</h2>

    <p>This documentation may be updated at least one time per year. As an user, you must stay up to date in this agreement, please follow updates of this document.</p>
    <p>You own the right to retract yourself from our service if you don't agree to this document.</p>
    <p>In this case, you will need to:</p>
    <ol>
        <li>Stop using the service</li>
        <li>Remove all your accounts on our service</li>
        <li>Remove all your data on our service</li>
    </ol>

    <p>You can simply destroy your account and all the related data using the Movim configuration panel, Account tab, "Delete your Account" button. We might keep some account related data for some times regarding our <a href="#privacy_policy">Privacy Policy</a>.</p>
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
