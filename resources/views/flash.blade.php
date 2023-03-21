@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif
