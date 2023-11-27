$(document).ready(function(){
    $(document).on('click', '#js-addcart-detail', function(){
        var size = $('#size').val();
        var color = $('#color').val();
        var quantity = $('#quantity').val();

        $.ajax({
            url : '{{route(\'add-to-cart\')}}',
            type: 'POST',
            data:{
                'size' : size,
                'color': color,
                'quantity': quantity,
            },
            success: function (data) {
                alert(data);
            }
        })
    });
});
