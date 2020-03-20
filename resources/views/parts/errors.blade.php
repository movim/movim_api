@if ($errors->any())
<ul class="list middle">
    <li>
        <span class="primary icon color bubble red">
            <i class="material-icons">warning</i>
        </span>
        <p>Invalid form</p>
        <p>
            @foreach ($errors->all() as $error)
                {{$error}}<br />
            @endforeach
        </p>
    </li>
</ul>
@endif