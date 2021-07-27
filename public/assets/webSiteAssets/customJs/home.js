$(document).ready(()=>{
// href="reservation-1.html"

    $('#bookNow').on('click' , ()=>{

        let hotelId = $("#hotelId").val()
        let checkIn = $("#arrivalDate").text()
        let checkOut = $("#departureDate").text()
        let noOfGuests = $("#qty-result-text").text()

        window.open("/room-overview/rooms-list?hotelId="+hotelId+"&arrivalDate="+checkIn+"&departureDate="+checkOut+"&guests="+noOfGuests);
    });


    $('#destination').on('click' , ()=>{
        
        $('#hotelsList').toggle('disply-hotel-list')
        console.log($('#hotelsList').find('a'))
    })



});

function getVal(val , hotelId) { 
    $("#selectedHotel").text(val)
    $('#hotelId').val(hotelId)
    
 }
