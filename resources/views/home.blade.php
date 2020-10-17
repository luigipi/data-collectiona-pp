@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-lg-9 col-md-9 bg-white p-4">
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
        <h4>Registrations</h4>
        <div class="pagination">
            {{$users->links()}}
        </div>
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
              <?php $i = 1 ?>
            <tr>
              @foreach ($users as $user)
                  <td>{{$i++}}</td>
                  <td>{{$user->reg_number}}</td>
                  <td>{{$user->first_name.' '.$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone_number}}</td>
                  <td>{{$user->occupation}}</td>
                  <td class="d-flex"> 
                    <a href="{{url('/').'/edit/'.$user->id}}" class="mr-2">edit</a>
                    <form action="{{url('/').'/delete/'.$user->id}}" method="POST">
                        @csrf
                      @method("DELETE")
                      <button class="btn btn-sm text-danger">delete</button>
                    </form>
                  </td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection