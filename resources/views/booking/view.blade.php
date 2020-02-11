@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3>Booking Detail</h3>
            <table class="table table-striped">
                <tr>
                    <td><b>Name:</b> </td>
                    <td>{{$booking->name}} </td>
                </tr>
                <tr>
                    <td><b>Email: </b></td>
                    <td>{{$booking->email}} </td>
                </tr>
                <tr>
                    <td><b>Booking Type: </b></td>
                    <td>{{$booking->type}} </td>
                </tr>
                <tr>
                    <td><b>Booking slot: </b></td>
                    <td>{{(!empty($booking->slot))?$booking->slot:'--'}} </td>
                </tr>
                <tr>
                    <td><b>Booking Date: </b></td>
                    <td>{{$booking->date}} </td>
                </tr>
                <tr>
                    <td><b>Booking Time:</b> </td>
                    <td>{{$booking->time}} </td>
                </tr>

            </table>
        </div>
    </div>

@endsection
