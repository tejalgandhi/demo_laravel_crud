@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3>Booking Details</h3>
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
        <div class="text-right"><button type="button" onclick="window.location='{{ url("/booking/create") }}'" class="btn btn-primary"> Add Booking</button></div>
        <table class="table table-striped">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Booking Type</th>
                <th>Booking Date</th>
                <th>Booking Slot</th>
                <th>Booking Time</th>
                <th colspan="6" class="text-center">Actions</th>
            </tr>
            <?php $i=1 ?>
            @foreach($bookings as $booking)
                <tr class = "text-center">
                    <td>{{$i++}}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->type }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ !empty($booking->slot)?$booking->slot:'--' }}</td>
                    <td>{{ $booking->time }}</td>
                    <td ><a href="{{route('booking.show',['id'=>$booking->id])}}" class = "btn btn-info">View</a><td>
                    <td ><a href="{{route('booking.edit',['id'=>$booking->id])}}" class = "btn btn-primary">Edit</a><td>
                    <td><a href="{{route('booking.destroy',['id'=>$booking->id])}}" class = "btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </table>
        {{ $bookings->links() }}

    </div>
</div>
@endsection
