@if ($errors->any())
<ul class="list middle">
    <li>
        <span class="primary icon color bubble red">
            <i class="material-symbols">warning</i>
        </span>
        <div>
            <p>Invalid form</p>
            <p>
                @foreach ($errors->all() as $error)
                    {{$error}}<br />
                @endforeach
            </p>
        </div>
    </li>
</ul>
@endif