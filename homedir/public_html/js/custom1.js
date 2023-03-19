(function ($) {
  "use strict";

  
  function CreatePDFfromHTML1(title) {
    var HTML_Width = $("#div").width();
    console.log(HTML_Width);
    var HTML_Height = $("#div").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + top_left_margin * 2;
    var PDF_Height = PDF_Width * 1.5 + top_left_margin * 2;
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#div")[0]).then(function (canvas) {
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
      var pdf = new jsPDF("p", "pt", [PDF_Width, PDF_Height]);
      pdf.addImage(
        imgData,
        "JPG",
        top_left_margin,
        top_left_margin,
        canvas_image_width,
        canvas_image_height
      );
      for (var i = 1; i <= totalPDFPages; i++) {
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(
          imgData,
          "JPG",
          top_left_margin,
          -(PDF_Height * i) + top_left_margin * 4,
          canvas_image_width,
          canvas_image_height
        );
      }      

      // Output pdf and attachment to email -> send with phpmailer
      var blob = pdf.output('blob');

      var formData = new FormData();
      formData.append('pdf', blob);

      $.ajax('./gmail-email/index.php',
        {
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (data) { console.log(data) },
          error: function (data) { console.log(data) }
        });
      $(".html-content").hide();
    });
  }

  $(".pdf-download1").on("click", function () {
    var title = $(this).data("name");
    CreatePDFfromHTML1(title);
    return false;
  });

  
  
  
})(jQuery);


