@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-0 justify-content-center">
      <div class="col-md-12 bg-white">
        <table class="table table-responsive table-condensed table-stripe">
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Occupation</th>
            <th>Address</th>
            <th>Payment status</th>
            <th>Manage <img src="{{asset('imgs/loader.gif')}}" width="30" class="hidden" id="loader"></th>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($getRecords as $record)
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{$record->fname}} {{$record->lname}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{$record->phone_number}}</td>
                        <td>{{$record->occupation}}</td>
                        <td>{{$record->email}}</td>
                        <td class="text-center">
                            @if ($record->status === '0')
                                <strong class="success">Paid</strong>
                            @else
                                <strong class="red-tag">pending</strong>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{$record->id}}" class="sendMail btn btn-warning btn-sm">
                                send mail {{$record->id}}
                            </a>
                           <!-- <form action="#" id="mailForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="user_id" type="hidden" value="{{$record->id}}">
                                <a href="javascript:void(0)" data-id="{{$record->id}}" class="sendMail btn btn-warning btn-sm">
                                    send mail {{$record->id}}
                                </a>
                            </form>-->
                        </td> 
                    </tr>
               @endforeach
            </tbody>
        </table>
     </div>
    </div>
</div>
@endsection
