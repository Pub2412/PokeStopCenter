@extends('errors.themed')

@section('title', 'Access Denied')

@section('error-code', '403')
@section('error-heading', 'Access Denied')
@section('error-message', 'You do not have permission to access this page.')

@section('error-extra')
    @if(auth()->check())
        Your current role is "{{ auth()->user()->role }}" and this resource requires admin access.
    @else
        Please log in to access this page.
    @endif
@endsection

@section('error-actions')
    @if(!auth()->check())
        <a href="{{ route('auth.login') }}" class="error-btn error-btn-secondary">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
    @endif
@endsection
