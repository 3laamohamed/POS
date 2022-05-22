<script>
    let _token = $('input[name="_token"]').val();
    let dateDIv = $(".date-time .date");
    let timeDIv = $(".date-time .time");

    $('#selectop').on('change', function() {
        let job = $(this).val();
        console.log(job)
        $.ajax({
        url: "{{route('change_op')}}",
        method: 'post',
        enctype: "multipart/form-data",
        data: {
            _token    : _token,
            job       : job,
        },
        success: function (data) {
            $('#foateer').html(data.foateer)
            $('#salesshow').html(data.sales)
            $('#sales_agel').html(data.agel)
            $('#sales_back').html(data.back)
            $('#sales_backacc').html(data.backofcus)

            $('#foateer_buy').html(data.foateer_buy)
            $('#buy').html(data.buy)
            $('#buy_aggel').html(data.buy_aggel)
            $('#buy_back').html(data.buy_back)
            $('#buy_backacc').html(data.buy_backacc)


            $('#Spending').html(data.Spending)
            $('#supply').html(data.supply)
            $('#exchange').html(data.exchange)
            $('#total').html(data.total)
        },
        });
    });
</script>