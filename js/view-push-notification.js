$(document).ready(function () {
  $(".loading").hide();
  $("#api-whatsapp").validate({
    rules: {
      phone: "required",
    },
    errorPlacement: function (error, element) {
      if (element.is(":radio")) {
        error.appendTo(element.parents("label"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element) {
      $(element).closest("label").addClass("has-error");
      $(element).addClass("invalid");
    },
    unhighlight: function (element) {
      $(element).closest("label").removeClass("has-error");
      $(element).removeClass("invalid");
    },
    errorClass: "invalid-text",
    ignoreTitle: true,
    submitHandler: function (form) {
      let phone = $("#phone").val();
      let pat_name = $("#pat_name").val();
      let pat_id = $("#pat_id").val();
      let study_desc = $("#study_desc").val();
      let uid = $("#uid").val();
      let acc = $("#acc").val();
      let updated_time = $("#updated_time").val();
      let bearer_token = $("#bearer_token").val();
      let template_code_id = $("#template_code_id").val();
      let textBody = `Assalamualaikum Wr. Wb. Selamat Datang di RSUD SUMEDANG. Kepada Yth. Bpk/ibu/Sdr ${pat_name} : Layanan : RADIOLOGI NO MR : ${pat_id} Tanggal : ${updated_time} No Accession : ${acc} Jenis Pemeriksaan : ${study_desc} Berikut kami kirimkan link untuk mengakses hasil pemeriksaan radiologi, Klik link dicom: http://182.253.37.203:8089/mms/pasien.php?uid=${uid} Akses link dicom disarankan menggunakan komputer/laptop agar tampilan gambar bisa lebih maksimal. Hasil pemeriksaan radiologi juga bisa di akses melalui scan barcode yg ada di pojok kiri bawah hasil expertise/bacaan pada file PDF. Hasil hanya bisa diakses selama 1 bulan dari tanggal pemeriksaan > Kami memperkenalkan fasilitas WA Sender Gateway, mohon SAVE menjadi Kontak sebagai WA Sender. Nomor ini tidak bisa membalas chat dan menerima telepon. Bila ada keraguan hasil silahkan hubungi unit Radiologi ke wa.me/62882006971716 (WA Radiologi) Terimakasih atas kepercayaan yang diberikan kepada kami. Wassalamu'alaikum Wr. Wb`;
      $.ajax({
        type: "POST",
        url: "https://wa01.ocatelkom.co.id/api/v2/push/message",
        data: {
          phone_number: phone,
          message: {
            type: "template",
            template: {
              template_code_id: template_code_id,
              payload: [
                {
                  position: "header",
                  parameters: [
                    {
                      type: "image",
                      image: {
                        url: "https://image.com/api/jk.img",
                      },
                    },
                  ],
                },
                {
                  position: "body",
                  parameters: [
                    {
                      type: "text",
                      text: textBody,
                    },
                  ],
                },
              ],
            },
          },
        },
        headers: {
          Authorization: "Bearer " + bearer_token,
        },
        beforeSend: function () {
          $(".loading").show();
          $(".ubah").hide();
        },
        complete: function () {
          $(".loading").hide();
          $(".ubah").show();
        },
        success: function (response) {
          let res = JSON.parse(response);
          $("#input").html(res.input);
          $("#output").html(res.output);
          swal({
            title: "check status",
            icon: "success",
            timer: 1000,
          });
          // setTimeout(function() {
          // 	window.location.href = "workload.php";
          // }, 1000);
        },
        error: function (xhr, textStatus, error) {
          let message = xhr.responseJSON.errors[0].message;
          let code = xhr.responseJSON.errors[0].code;
          try {
            swal({
              title: message,
              text: code,
              icon: "error",
              timer: 2000,
            });
            $("#input").html(textBody);
            $("#output").html(
              "Message : <b>" +
                message +
                "</b> <br /> Kode : <b>" +
                code +
                "</b>"
            );
          } catch (error) {
            swal({
              title: textStatus + ", Hubungi IT",
              icon: "error",
              timer: 1500,
            });
          }
        },
      });
    },
  });
});
