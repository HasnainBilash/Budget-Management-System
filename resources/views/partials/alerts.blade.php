@if (session('success'))
    <div class="alert-success mb-6">{{ session('success') }}</div>
@endif

@if (session('status'))
    <div class="alert-success mb-6">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div class="alert-error mb-6">
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
