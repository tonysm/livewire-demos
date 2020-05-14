<div>
    <ul>
        @foreach($boats as $boat)
            <li>{{ $boat->name }}</li>
        @endforeach
    </ul>
</div>
