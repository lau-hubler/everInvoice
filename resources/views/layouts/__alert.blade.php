@if($errors->any())
    <p-alert variant="danger" dismiss="0">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </p-alert>
@endif
