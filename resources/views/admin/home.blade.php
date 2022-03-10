@extends('layouts.admin')
@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h1>
                Welcome {{ Auth::user()->name }} - {{ Auth::user()->userInfo()->first()->phone }} 
                {{-- nel caso del telefono devo prendere i dati attraverso la mia tabella di relazione in questo caso user info --}}
            </h1>
        </div>
    </div>
</div>
@endsection
