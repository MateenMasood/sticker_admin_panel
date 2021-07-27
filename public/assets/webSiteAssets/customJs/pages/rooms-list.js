$(document).ready(()=>{
    $("#noOfRooms").on('change' , ()=>{
        $('#setRoomNumber').text($('#noOfRooms option:selected').val())

    })


    $('#destination').on('click' , ()=>{
        
        $('#hotelsList').toggle('disply-hotel-list')
        console.log($('#hotelsList').find('a'))
    })

    // $('#hotelsList').on('click' , ()=>{
    //     $('#hotelsList').toggle('disply-hotel-list')

    // })


})

function getVal(val , hotelId) { 
    // $("#selectedHotel").text(val)
    $('#destination').val(val)
    $('#hotelId').val(hotelId)
    $('#hotelsList').toggle('disply-hotel-list')

    
 }
