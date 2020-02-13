<template>
    
    <div class="row justify-content-center mt-3">
        <div class="col-lg-3 d-flex align-items-center">
            <img src="image/ulo2.png" alt="">
        </div>
        <div class="col-lg-5" style="border: 1px solid gray">
            <div class="row mt-3">
                <h1>SEATS here</h1>
                <!-- @foreach ($seats as $index => $seat)
                    @if ($index > 15 && $index < 23)
                    <div class="col-lg-1 mt-3 mb-3 ml-2 mr-2 d-flex">
                        <input type="radio" name="seat" value="{{ $seat->id }}" {{ ($seat->status == 'Available') ? '' : 'disabled'}}>
                        <img src="{{ ($seat->status == 'Available') ? 'image/stall.png' : 'image/booked_seat_img.gif' }}">
                    </div>
                    @else
                    <div class="col-lg-1 mt-3 mb-3 ml-2 mr-2 d-flex">
                        <input type="radio" name="seat" value="{{ $seat->id }}" {{ ($seat->status == 'Available') ? '' : 'disabled'}}>
                        <img src="{{ ($seat->status == 'Available') ? 'image/available_seat_img.gif' : 'image/booked_seat_img.gif' }}">
                    </div>
                    @endif
                    
                @endforeach -->
            </div>
        </div>
    </div>
    
</template>