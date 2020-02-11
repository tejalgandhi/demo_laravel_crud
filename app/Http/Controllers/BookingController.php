<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $booking;
    public function __construct(Booking $booking)
    {
        $this->booking=$booking;
    }

    public function index()
    {
        try{
            $bookings=$this->booking->paginate(10);
            return view('booking.index', compact('bookings'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        try{
            $type=$request->get('type');
            $slot=$request->get('slot');
            $existBooking=false;
            if ($type == 'Full day') {
                $existBooking = $this->booking->where('date', $request->get('date'))->exists();
            } else {
                $bookingData = $this->booking->where('date', $request->get('date'))->get();
                if (!empty($bookingData)) {
                    foreach ($bookingData as $booking) {
                        if ($booking->type == 'Full day') {
                            $existBooking = true;
                        } else {
                            if ($booking->slot == $slot) {
                                $existBooking = true;
                            }
                        }
                    }
                }
             }
            if($existBooking){
                return redirect()->back()->with('error','Booking already exist for this date.');
            }
            else {
                $booking = $this->booking->create($request->all());

                return redirect()->back()->with('success', 'Booking store successfully');
            }

        }
        catch (\Exception $exception){
            \Log::error($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $booking = $this->booking->find($id);
            if (empty($booking))
            {
                abort(404);
            }
                return view('booking.view', compact('booking'));

        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            abort(404);
        }
    }

    /**
     * Show the form for `ing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            //Find the Booking
            $booking = $this->booking->find($id);
            return view('booking.create',['booking'=> $booking]);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $request, $id)
    {
        try{
            $type=$request->get('type');
            $slot=$request->get('slot');
            $existBooking=false;
            if ($type == 'Full day') {
                $existBooking = $this->booking->where('date', $request->get('date'))->where('id','!=',$id)->exists();
//                dd($existBooking);
            } else {
                $bookingData = $this->booking->where('date', $request->get('date'))->where('id','!=',$id)->get();
                if (!empty($bookingData)) {
                    foreach ($bookingData as $booking) {
                        if ($booking->type == 'Full day') {
                            $existBooking = true;
                        } else {
                            if ($booking->slot == $slot) {
                                $existBooking = true;
                            }
                        }
                    }
                }
            }
            if($existBooking){
                return redirect()->back()->with('error','Booking already exist for this date.');
            }
            else {
                $booking = $this->booking->where('id',$id)->update($request->except('_token'));

                return redirect()->back()->with('success', 'Booking updated successfully.');
            }

        }
        catch (\Exception $exception){
            \Log::error($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            //Retrieve the Booking
            $booking = $this->booking->find($id);
            //delete
            $booking->delete();
            return redirect()->back()->with('success','Booking deleted successfully.');

        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
}
