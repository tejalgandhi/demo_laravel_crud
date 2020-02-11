@extends('layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">

            {!! Session::get('success') !!}

        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">

            {!! Session::get('error') !!}

        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all(':message') as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>

    @endif
    @if(!empty($booking))
        <form method="post" action="{{route('booking.update',$booking->id)}}">
            {{--<input type="hidden" name="id" value="{{$booking->id}}">--}}
    @else
         <form method="post" action="{{route('booking.store')}}">
    @endif
                    @csrf
                    <h3>Booking</h3>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{(!empty($booking)?$booking->name:'')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{(!empty($booking)?$booking->email:'')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="booking_type">Booking Type:</label>
                        <select class="form-control" id="booking_type" name="type">
                            <option name="full day" {{(!empty($booking)&&$booking->type=='Full day')?'selected':''}} >Full day</option>
                            <option name="half day" {{(!empty($booking)&&$booking->type=='Half day')?'selected':''}}>Half day</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Booking Date:</label>
                        <input class="date form-control" type="text" id="datepicker" name="date" value="{{(!empty($booking)?$booking->date:'')}}" required>
                    </div>
                    <div class="form-group slot">
                        <label for="booking_slot">Booking Slot:</label>
                        <select class="form-control" name="slot" id="booking_slot">
                            <option name="Morning" {{(!empty($booking)&&$booking->slot=='Morning')?'selected':''}}>Morning</option>
                            <option name="Evening" {{(!empty($booking)&&$booking->slot=='Evening')?'selected':''}}>Evening</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="booking_time">Booking Time:</label>
                        <input class="timepicker form-control" type="text" name="time" value="{{(!empty($booking)?$booking->time:'')}}" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
@endsection
@section('script')

    @include('js.booking')

@endsection

