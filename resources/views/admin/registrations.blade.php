@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-lg-9 col-md-9">
        <h4>Registrations</h4>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Raffle Number</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Occupation</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach ($users as $user)
                  <td>{{$user->reg_number}}</td>
                  <td>{{$user->first_name.' '.$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone_number}}</td>
                  <td>{{$user->occupation}}</td>
                  <td>
                    <a href="{{url('/').'/edit'}}">edit</a>
                    <form action="{{url().'/delete/'.$user->id}}">
                      @method('DELETE')
                      <button class="btn-sm text-danger">delete</button>
                    </form>
                  </td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endsection