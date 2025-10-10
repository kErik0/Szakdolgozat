@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email cím megerősítése</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Egy új megerősítő linket elküldtünk az email címedre.
                        </div>
                    @endif

                    Mielőtt folytatnád, kérjük, ellenőrizd az email fiókodat a megerősítő linkért.
                    Ha nem kaptad meg az emailt,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">kattints ide egy új linkért</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
