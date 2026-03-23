@extends('errors.themed')

@section('title', 'Too Many Requests')

@section('error-code', '429')
@section('error-heading', 'Too Many Requests')
@section('error-message', 'Too many attempts were detected. Please wait a moment and try again.')
