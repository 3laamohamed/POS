<script>
  let _token = $('input[name="_token"]').val();
  /* =================== Add New Unit ####################### */
  $('#save_unit').on('click',function (e) {
    e.preventDefault();
    let mybut  = $(this);
    let serial = $('#serial').val();
    let unit   = $('#unit').val();
    $.ajax({
      url: "{{route('save.unit')}}",
      method: 'post',
      enctype: "multipart/form-data",
      data: {
        _token: _token,
        serial: serial,
        unit  : unit
      },
      success: function (data) {
        if(data.status == 'true')
        {
          mybut
            .parents(".modal")
            .modal("hide");
          cuteToast({
            type: "success",
            message: "تم الاضافة بنجاح",
            timer: 2000
          });
          serial++
          $('#new_serial').attr('value',serial);
          $('#name_uint').val('');
        }
      }
    });
  });
  /* ================== Update Unit ####################### */
  $('#update_unit').on('click',function (e) {
    e.preventDefault();
    let mybut  = $(this);
    let serial = $('#serial').val();
    let unit   = $('#unit').val();
    $.ajax({
      url: "{{route('update.unit')}}",
      method: 'post',
      enctype: "multipart/form-data",
      data: {
        _token: _token,
        serial: serial,
        unit  : unit
      },
      success: function (data) {
        if(data.status == 'true')
        {
          mybut
            .parents(".modal")
            .modal("hide");
          cuteToast({
            type: "success",
            message: "تم الاضافة بنجاح",
            timer: 2000
          });
          $('#unit').val('');
        }

      },
      error: function (reject) {
        var response  = $.parseJSON(reject.responseText);
        $.each(response.errors , function (key, val)
        {
          $(`#${key}`).addClass('error');
          cuteToast({
              type: "error",
              message: val,
              timer: 4000
            });
        });
      }
    });
  });
  /* ================== Delete Unit ####################### */
  $('.remove-button').on('click',function (e) {
    e.preventDefault();
    let myModal = $(this).parents(".modal");
    let serial = $('#serial').val();
    let myRow = $(`tr[row_id='${serial}']`);
    cuteAlert({
      type: "question",
      title: "حذف المنتج",
      message: "هل متأكد انك تريد حذف المنتج؟",
      confirmText: "موافق",
      cancelText: "إلغاء"
    }).then(e => {
      if (e == "confirm") {
        $.ajax({
          url: "{{route('delete.unit')}}",
          method: 'post',
          enctype: "multipart/form-data",
          data: {
            _token: _token,
            serial: serial,
          },
          success: function (data) {
            myRow.remove();
            myModal.modal("hide");
            cuteToast({
              type: "success",
              message: "تم الحذف بنجاح",
              timer: 2000
            });
            $('#new_serial').attr('value',data.serial);
            $('#name_uint').val('');

          }
        });

      } else {
      }
    });
  });
  /* ================== Search Unit ####################### */
  $('#search').on('click',function (e) {
    e.preventDefault();
    let text = $('#search_value').val();
    $.ajax({
      url: "{{route('search.unit')}}",
      method: 'post',
      enctype: "multipart/form-data",
      data: {
        _token: _token,
        text  : text,
      },

      success: function (data) {
        let html = '';
        for(var count = 0 ; count < data.length ; count++)
        {
         html+=` <tr row_id='${data[count].id}'>`
            html+=`<td> <span data-input='row-id'>${data[count].id}</span> </td>`
            html+=`<td> <span data-input='unit_name'>${data[count].name}</span> </td>`
            html+=`<td class='checkbox-td' onclick='event.stopPropagation()'>`
              html+=`<label class="checker">`
                if(data[count].status == 1)
                {
                  html+=`<input class="checkbox" type="checkbox" checked/>`

                }else{
                  html+=`<input class="checkbox" type="checkbox"/>`
                }
                html+=`<div class="check-bg"></div>`
                html+=`<div class="checkmark">`
                  html+=`<svg viewBox="0 0 100 100">`
                    html+=`<path d="M20,55 L40,75 L77,27" fill="none" stroke="#FFF" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" />`
                  html+=`</svg>`
                html+=`</div>`
              html+=`</label>`
            html+=`</td>`
          html+=`</tr>`
        }
        $('tbody').html(html);

      }

    });
  });
  /* ================== Active Product #################### */
  $('.checkbox-td input').on('change', function() {
    let serial = $(this).parents('tr').attr('row_id');
    let active = '';
    if ($(this).is(':checked')) {
      active = 1;
    } else {
      active = 0;
    }
    $.ajax({
      url: "{{route('active.unit')}}",
      method: 'post',
      enctype: "multipart/form-data",
      data: {
        _token: _token,
        serial: serial,
        active  : active
      },
      success: function (data) {
      }
    });

  });
</script>
