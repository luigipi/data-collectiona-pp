@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-7 col-lg-7 bg-white p-4">
      @if (session('message'))
          <div class="alert alert-success">
              {{session('message')}}
          </div>
      @endif
      @if (session('errors'))
          <div class="alert alert-danger">
              {{session('errors')}}
          </div>
      @endif
      <h4>Edit</h4>
      <form action="{{url('/').'/update/'.$user->id}}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        @method('PUT')
        <div class="row mb-2">
          <div class="col">
            <label htmlFor="first_name">First Name:</label>
            <input 
              type="text" 
              name="first_name" 
              class="form-control" 
              placeholder="First Name" 
              required
              value="{{$user->first_name}}"
            />
          </div>
          <div class="col">
            <label htmlFor="last_name">Last Name:</label>
            <input 
              type="text" 
              name="last_name" 
              class="form-control" 
              placeholder="Last Name" 
              required
              value="{{$user->last_name}}"
            />
          </div>
        </div>
        <div class="row mb-2">
          <div class="col">
            <label htmlFor="email">Email Address:</label>
            <input 
              type="email" 
              name="email" 
              class="form-control" 
              placeholder="Email address" 
              required
              value="{{$user->email}}"
            />
          </div>
          <div class="col">
            <label htmlFor="phone_number">Phone Number:</label>
            <input 
              type="tel" 
              name="phone_number" 
              class="form-control" 
              placeholder="Phone Number" 
              required
              value="{{$user->phone_number}}"
            />
          </div>
        </div>
        <div class="form-group">
          <label htmlFor="occupation">Occupation:</label>
          <input 
            type="text" 
            name="occupation" 
            placeholder="Occupation" 
            class="form-control"
            value="{{$user->occupation}}"
          />
        </div>
        <button class="btn btn-primary btn-lg">
          Submit
        </button>
      </form>
    </div>
  </div>
@endsection