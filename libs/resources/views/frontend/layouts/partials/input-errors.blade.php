@if($errors->any())
    <div class="alert alert-danger alert-dismissible w-full">
        <h4><i class="icon fa fa-ban"></i> خطا!</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
