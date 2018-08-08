@extends('layouts.admin.index')
@section('title')
Welcome {{ $users->name }}
@endsection('title')

@section('content')
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Admin Page</li>
          </ol>

          <!-- Page Content -->
          <h1>Welcome {{ $users->name }}</h1>
          <hr>

@endsection('content')