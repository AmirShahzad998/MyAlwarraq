<div class="row">
    <div class="col-12">
        @if (session('status'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ session('status') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
</div>
