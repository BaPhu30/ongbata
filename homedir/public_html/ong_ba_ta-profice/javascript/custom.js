(function ($) {
    "use strict";
  
    jQuery.fn.scrollCenter = function (elem, speed) {
      var active = jQuery(this).find(elem);
      var activeWidth = active.width() / 2;
      var pos = active.position().left + activeWidth;
      var elpos = jQuery(this).scrollLeft();
      var elW = jQuery(this).width();
      pos = pos + elpos - elW / 2;
  
      jQuery(this).animate(
        {
          scrollLeft: pos,
        },
        speed == undefined ? 1000 : speed
      );
      return this;
    };
  
    jQuery.fn.scrollCenterORI = function (elem, speed) {
      jQuery(this).animate(
        {
          scrollLeft:
            jQuery(this).scrollLeft() -
            jQuery(this).offset().left +
            jQuery(elem).offset().left,
        },
        speed == undefined ? 1000 : speed
      );
      return this;
    };
  
    //- Droped menu
  
    $.puerto_droped = function (prtclick, prtlist = "ul.pt-drop") {
      $(prtclick).livequery("click", function () {
        var ul = $(this).parent();
        if (ul.find(prtlist).hasClass("open")) {
          ul.find(prtlist).removeClass("open");
          $(this).removeClass("active");
          if (prtclick == ".pl-mobile-menu") $("body").removeClass("active");
        } else {
          $("ul.pt-drop").parent().find(".active").removeClass("active");
          $("ul.pt-drop").removeClass("open");
          ul.find(prtlist).addClass("open");
          $(this).addClass("active");
          if (prtclick == ".pl-mobile-menu") $("body").addClass("active");
        }
        return false;
      });
      $("html, body").livequery("click", function () {
        $("ul.pt-drop").parent().find(".active").removeClass("active");
        $("ul.pt-drop").removeClass("open");
        if (prtclick == ".pl-mobile-menu") $("body").removeClass("active");
      });
    };
  
    $.puerto_droped(".pt-notyshow");
    $.puerto_droped(".pt-options-link");
  
    $(document).ready(function () {
      if ($(".pt-sm .active").length) {
        $(".pt-sm").scrollCenter(".active", 300);
      }
    });
  
    $.puerto_confirm = function (tit, aler, col) {
      "use strict";
      $.confirm({
        icon: col == "green" ? "far fa-laugh-wink" : "far fa-surprise",
        theme: "modern",
        closeIcon: true,
        animation: "scale",
        type: col,
        title: tit,
        content: aler,
        buttons: false,
      });
    };
  
    $("input[name=search]").on("keyup keydown change", function () {
      var th = $(this);
      var vl = $(this).val();
       if (vl !="") {
          $.post(path + "/ajax.php?pg=search", { search: vl }, function (puerto) {
            $(".sresults").html(puerto);
            th.parent().find("ul").addClass("open");
          });
       }
    });
  
    $(".partner").parent().addClass("haswife");
  
    $(".login-link").livequery("click", function () {
      var th = $(this);
      $("#send-login").show();
      $("#send-user").hide();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $(".register-link").removeClass("active");
      }
      return false;
    });
  
    $(".register-link").livequery("click", function () {
      var th = $(this);
      $("#send-login").hide();
      $("#send-user").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $(".login-link").removeClass("active");
      }
      return false;
    });
  
    $(".nav-tabs a").livequery("click", function () {
      var th = $(this).parent();
      if (!th.hasClass("active")) {
        $(".nav-tabs a").parent().removeClass("active");
        th.addClass("active");
      }
    });
  
    $("[rel=prof]").livequery("click", function () {
      var th = $(this);
      $(".comp, .inter, .bio, .photos").hide();
      $(".prof").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $("[rel=comp], [rel=inter], [rel=bio], [rel=photos]").removeClass(
          "active"
        );
      }
      return false;
    });
    $("[rel=comp]").livequery("click", function () {
      var th = $(this);
      $(".prof, .inter, .bio, .photos").hide();
      $(".comp").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $("[rel=prof], [rel=inter], [rel=bio], [rel=photos]").removeClass(
          "active"
        );
      }
      return false;
    });
    $("[rel=inter]").livequery("click", function () {
      var th = $(this);
      $(".prof, .comp, .bio, .photos").hide();
      $(".inter").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $("[rel=prof], [rel=comp], [rel=bio], [rel=photos]").removeClass(
          "active"
        );
      }
      return false;
    });
    $("[rel=bio]").livequery("click", function () {
      var th = $(this);
      $(".prof, .comp, .inter, .photos").hide();
      $(".bio").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $("[rel=prof], [rel=comp], [rel=inter], [rel=photos]").removeClass(
          "active"
        );
      }
      return false;
    });
    $("[rel=photos]").livequery("click", function () {
      var th = $(this);
      $(".prof, .comp, .inter, .bio").hide();
      $(".photos").show();
      if (!th.hasClass("active")) {
        th.addClass("active");
        $("[rel=prof], [rel=comp], [rel=inter], [rel=bio]").removeClass("active");
      }
      return false;
    });
  
    $("#send-newmember").livequery("submit", function () {
      var id = $("[name=parent]").val();
      var nid = $("[name=nid]").val();
      var rl = $("[rel=item-" + id + "]");
      var ul = rl.parent();
  
      var formData = new FormData($(this)[0]);
  
      $.ajax({
        url: path + "/ajax.php?pg=send-newmember",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
          $("#myModal").modal("hide");
          location.reload();
        },
        cache: false,
        contentType: false,
        processData: false,
      });
  
      return false;
    });
  
    $("#send-vpass").livequery("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=vpass-send",
        $(this).serialize(),
        function (puerto) {
          th.find("hr").before($(puerto.msg).hide().fadeIn());
          setTimeout(function () {
            th.find(".alert").fadeOut(function () {
              $(this).remove();
            });
          }, 4000);
          if (puerto.type == "success") {
            setTimeout(function () {
              location.reload();
            }, 4000);
          }
        },
        "json"
      );
  
      return false;
    });
  
    $("#send-newheritage").livequery("submit", function () {
      $.post(
        path + "/ajax.php?pg=newheritage",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            setTimeout(function () {
              location.reload();
            }, 2500);
            $.puerto_confirm(lang.success, puerto.msg, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.msg, "red");
          }
        },
        "json"
      );
  
      return false;
    });
  
    function CreatePDFfromHTML(title) {
      var HTML_Width = $("#div").width();
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
        pdf.save(title + ".pdf");
        $(".html-content").hide();
      });
    }
  
    $(".pdf-download").on("click", function () {
      window.devicePixelRatio = 2
      var title = $(this).data("name");
      CreatePDFfromHTML(title);
      return false;
    });
  
    if ($("#div").length) {
      const element = document.getElementById("div");
      const panzoom = Panzoom(element, {});
      const parent = element.parentElement;
      parent.addEventListener("wheel", panzoom.zoomWithWheel);
  
      var zoomInButton = document.getElementById("zoomInButton");
      var zoomOutButton = document.getElementById("zoomOutButton");
      var resetButton = document.getElementById("resetButton");
      // var rangeInput = document.getElementById('rangeInput');
  
      zoomInButton.addEventListener("click", panzoom.zoomIn);
      zoomOutButton.addEventListener("click", panzoom.zoomOut);
      resetButton.addEventListener("click", panzoom.reset);
      // rangeInput.addEventListener("input", (event) => {
      //   panzoom.zoom(event.target.valueAsNumber);
      // });
    }
  
    $(".tree-add-fams").on("click", function () {
      $("#send-newheritage input[name=member]").val($(this).attr("rel"));
    });
  
    if ($(".colorpicker-popup").length) {
      $(".colorpicker-popup").spectrum({
        showInput: true,
        allowEmpty: true,
        preferredFormat: "hex",
        change: function (rr) {
          $("[name=pg_bg_v]").val(rr.toHexString());
        },
      });
    }
  
    $(".tree-edit").livequery("click", function () {
      var id = $(this).attr("rel");
  
      $("#send-newmember [name=id]").val(id);
      $.get(
        path + "/ajax.php?pg=tree-edit&id=" + id,
        function (data) {
          $("[name=firstname]").val(data.firstname);
          $("[name=lastname]").val(data.lastname);
          $("[name=birthdate]").val(data.birthdate);
          $("[name=mariagedate]").val(data.mariagedate);
          $("[name=deathdate]").val(data.deathdate);
          $("[name=longitude]").val(data.longitude);
          $("[name=latitude]").val(data.latitude);
          $("[name=photo]").val(data.photo);
          $("[name=email]").val(data.email);
          $("[name=site]").val(data.site);
          $("[name=tel]").val(data.tel);
          $("[name=mobile]").val(data.mobile);
          $("[name=birthplace]").val(data.birthplace);
          $("[name=deathplace]").val(data.deathplace);
          $("[name=profession]").val(data.profession);
          $("[name=company]").val(data.company);
          $("[name=interests]").val(data.interests);
          $("[name=bio]").val(data.bio);
          $("[name=type]").val(data.type);
          $("[name=instagram]").val(data.instagram);
          $("[name=facebook]").val(data.facebook);
          $("[name=twitter]").val(data.twitter);
          $("[name=user]").val(data.user);
          $('input[name="user"]').amsifySuggestags(
            {
              suggestionsAction: {
                url: path + "/sug.php",
              },
            },
            "refresh"
          );
  
          if (!data.useredit) {
            $(".link-u").hide();
          }
  
          $("select[name='type'] option[value='4']").attr("disabled", true);
  
          $("[name=gender][value=" + data.gender + "]").prop("checked", true);
          $("[name=death]").prop("checked", data.death == 1 ? true : false);
          $("#myModal").modal("show");
          var checkBox = document.getElementById("myCheck");
          var text = document.getElementById("inputDeadDate");
          if (checkBox.checked == true) {
            text.style.display = "none";
          } else {
            text.style.display = "block";
          }
        },
        "json"
      );
  
      return false;
    });
  
    $(".tree-add").livequery("click", function () {
      var id = $(this).attr("rel");
      var nid = $(this).attr("id") ? $(this).attr("id").replace("nid", "") : "";
  
      $("#send-newmember input[type=text], #send-newmember textarea").val("");
      $("#send-newmember [name=parent]").val(id);
      $("#send-newmember [name=nid]").val(nid);
  
      $.get(path + "/ajax.php?pg=tree-addpar&id=" + id, function (puerto) {
        if (puerto != 0) {
          $("select[name='type'] option[value='4']").attr("disabled", true);
        } else {
          $("select[name='type'] option[value='4']").attr("disabled", false);
        }
        $(".link-u").show();
        $("#myModal").modal("show");
      });
  
      return false;
    });
  
    $(".tree-delete").livequery("click", function () {
      var id = $(this).attr("rel");
      if (confirm(lang.alerts.de_mem)) {
        $.get(path + "/ajax.php?pg=tree-delete&id=" + id, function () {
          location.reload();
        });
      }
  
      return false;
    });
  
    $(".inputfile").livequery("change", function () {
      $(this)
        .parent()
        .find("label")
        .html('<i class="fa fa-upload"></i> ' + event.target.files[0].name);
      return false;
    });
  
    $("[rel^=item-]").livequery("click", function () {
      var id = $(this).attr("rel").replace("item-", "");
      $.get(
        path + "/ajax.php?pg=tree-edit&id=" + id,
        function (data) {
          var aemail = $("[rel=" + id + "e]").text();
          var html =
            '<div class="pt-item-details' +
            (data.gender == 1 ? " female" : "") +
            '">' +
            '<div class="thumb"><img src="' +
            path +
            "/" +
            data.photo +
            '" onerror="this.src=\'' +
            nophoto +
            "'\"></div>" +
            '<div class="pt-item-body">' +
            '<a class="pt-name">' +
            (data.lastname ? data.lastname : "") +
            " " +
            data.firstname +
            ' <i class="fas fa-' +
            (data.gender == 1
              ? 'female" title="' + lang.newmember.female + ""
              : 'male" title="' + lang.newmember.male + "") +
            '"></i></a>' +
            '<div> <a target="_blank" href=" ' +
            path +
            "/ong_ba_ta-profice/index/profile-ongbata.php?id=" +
            id +
            ' " class="btn btn-outline-info btn-block ">Nhấn vào để xem chi tiết</a></div>'+
            '<div class="btn-block " >'+
            '<center><span class="or_text"><b>Hoặc</b></span><div id="qrcode1" style="width:100px; height:100px;"></div></center>'+
            '<input id="link_qr" type="hidden" value="https://hovangiap.toidayhoc.com/ong_ba_ta-profice/index/profile-ongbata.php?id='+
            id +'" style="width:80%" />'+
             '<center><b>Quét mã QR </b></center> </div>'+
            (data.birthdate
              ? '<p class="pt-born">' +
              lang.newmember.bornat +
              " " +
              data.birthdate +
              (data.birthplace
                ? " " +
                lang.newmember.bornin +
                " <b>" +
                data.birthplace +
                "</b>"
                : "") +
              "</p>"
              : "") +
            (data.death == 0 && data.deathdate
              ? '<p class="pt-born">' +
              lang.newmember.deadat +
              " " +
              data.deathdate +
              (data.deathplace
                ? " " +
                lang.newmember.bornin +
                " <b>" +
                data.deathplace +
                "</b>"
                : "") +
              "</p>"
              : "") +
            (data.mariagedate
              ? '<p class="pt-born">' +
              lang.newmember.marriageat +
              " " +
              data.mariagedate +
              "</b></p>"
              : "") +
            '<p class="pt-links">' +
            (data.site
              ? '<a href="' +
              data.site +
              '" target="_blank" title="' +
              data.site +
              '"><i class="fas fa-link"></i></a>'
              : "") +
            (data.email
              ? '<a href="mailto:' +
              data.email +
              '" title="' +
              data.email +
              '"><i class="far fa-envelope"></i></a>'
              : "") +
            (data.tel
              ? '<a title="tel:' +
              data.tel +
              '"><i class="fas fa-phone-alt"></i></a>'
              : "") +
            (data.mobile
              ? '<a title="tel:' +
              data.mobile +
              '"><i class="fas fa-mobile-alt"></i></a>'
              : "") +
            (data.facebook
              ? '<a href="https://www.facebook.com/' +
              data.facebook +
              '" title="' +
              data.facebook +
              '"><i class="fab fa-facebook"></i></a>'
              : "") +
            (data.twitter
              ? '<a href="https://www.twitter.com/' +
              data.twitter +
              '" title="' +
              data.twitter +
              '"><i class="fab fa-twitter"></i></a>'
              : "") +
            (data.instagram
              ? '<a href="https://www.instagram.com/' +
              data.instagram +
              '" title="' +
              data.instagram +
              '"><i class="fab fa-instagram"></i></a>'
              : "") +
            "</p>" +
            "</div>" +
            '<p class="text-center text-muted"><small>Nhập thông tin bởi: ' +
            aemail +
            "</small><p>" +
            '<div class="pt-page-nav">' +
            '<div id="map" class="map-box-popup "></div>' +
            '<a class="btn btn-success dirlonglat text-light" onclick="drLongLat(' +
            data.latitude +
            "," +
            data.longitude +
            ')">Dẫn đường đến vị trí mộ ông bà</a>' +
            (data.profession
              ? '<b rel="prof" class="active">' +
              lang.newmember.profession +
              "</b>"
              : "") +
            (data.company
              ? '<b rel="comp">' + lang.newmember.company + "</b>"
              : "") +
            (data.interests
              ? '<b rel="inter">' + lang.newmember.interests + "</b>"
              : "") +
            (data.bio ? '<b rel="bio" href="#biodetail">' + lang.newmember.bio + "</b>" : "") +
            (data.photos
              ? '<b rel="photos">' + lang.newmember.photos + "</b>"
              : "") +
            "</div>" +
            '<p class="prof active">' +
            data.profession +
            "</p>" +
            '<p class="comp">' +
            data.company +
            "</p>" +
            '<p class="inter">' +
            data.interests +
            "</p>" +
            '<p class="bio">' +
            data.bio +
            "</p>" +
            '<div class="photos">' +
            data.photos +
            "</div>" +
            (!data.profession &&
              !data.company &&
              !data.interests &&
              !data.bio &&
              !data.photos
              ? '<div class="text-center">' + lang.alerts.nodata + "</div>"
              : "") +
            "</div>";
          $("#myTree .modal-body").html(html);
          $("#myTree").modal("show");
          getMap(data.latitude, data.longitude, data.lastname, data.firstname);
          function qrcode() {
            var qrcode = new QRCode(document.getElementById("qrcode1"), {
              width: 100,
              height: 100
            });

            function makeCode() {
              var elText = document.getElementById("link_qr");

              if (!elText.value) {
                alert("Input a text");
                elText.focus();
                return;
              }

              qrcode.makeCode(elText.value);
            }

            makeCode();

            $("#link_qr").
              on("blur", function () {
                makeCode();
              }).
              on("keydown", function (e) {
                if (e.keyCode == 13) {
                  makeCode();
                }
              });
          }
          qrcode();
        },
        "json"
      );
  
      return false;
    });
  
    if ($('input[name="planets"]').length) {
      $('input[name="planets"]').amsifySuggestags({
        suggestionsAction: {
          url: path + "/sug.php",
        },
        tagLimit: 10000,
      });
    }
    if ($('input[name="user"]').length) {
      $('input[name="user"]').amsifySuggestags({
        suggestionsAction: {
          url: path + "/sug.php",
        },
        tagLimit: 10000,
      });
    }
    if ($('input[name="heritage"]').length) {
      $('input[name="heritage"]').amsifySuggestags({
        suggestionsAction: {
          url: path + "/sugfamily.php",
        },
        tagLimit: 10000,
      });
    }
  
    // ** Register
  
    $("#send-user").livequery("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=user-send",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.msg, "green");
            setTimeout(function () {
              $(".pt-index-right").find("a").removeClass("active");
              $(".login-link").addClass("active");
              $("#send-login").show();
              $("#send-user").hide();
              $("#send-login input[name=name]").val(
                $("#send-user input[name=name]").val()
              );
              $("#send-login input[name=pass]").val(
                $("#send-user input[name=pass]").val()
              );
              if ($(".pt-pagedashboard").length) {
                location.reload();
              }
            }, 2000);
          } else {
            $.puerto_confirm(lang.error, puerto.msg, "red");
          }
        },
        "json"
      );
  
      return false;
    });
  
    // ** Send Login
  
    $("#send-login").livequery("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=login-send",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            setTimeout(function () {
              $(location).attr("href", path + "/index.php");
            }, 2500);
            $.puerto_confirm(lang.success, puerto.msg, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.msg, "red");
          }
        },
        "json"
      );
  
      return false;
    });
  
    // ** Logout
  
    $(".logout").on("click", function () {
      if (confirm(lang.alerts.logout)) {
        $.get(path + "/ajax.php?pg=logout", function () {
          $(location).attr("href", path + "/index.php");
        });
      }
      return false;
    });
  
    // ** Logout
  
    $("li.read-notifi").on("click", function () {
      var th = $(this),
        ii = 0;
      var rl = $(this).attr("rel");
      if (th.hasClass("read-notifi")) {
        $.get(path + "/ajax.php?pg=read-not&id=" + rl, function (puerto) {
          ii = parseInt(th.parent().parent().find("a b").text()) - 1;
          th.parent().parent().find("a b").text(ii);
          th.removeAttr("class");
        });
      }
    });
  
    // ** Family Details
  
    $("#loadingSendMail").addClass("d-none");
  
    $("#send-family-details").livequery("submit", function () {
      var th = $(this);
      $("#loadingSendMail").removeClass("d-none");
      $.post(
        path + "/ajax.php?pg=family-details",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            setTimeout(function () {
              location.reload();
            }, 4000);
            $.puerto_confirm(lang.success, puerto.msg, "green");
            $("#loadingSendMail").addClass("d-none");
          } else {
            $.puerto_confirm(lang.error, puerto.msg, "red");
            $("#loadingSendMail").addClass("d-none");
          }
        },
        "json"
      );
  
      return false;
    });
  
    $(".pt-edit").on("click", function () {
      var id = $(this).attr("rel");
      $.get(path + "/ajax.php?pg=family-edit&id=" + id, function (puerto) {
        var ass = JSON.parse(puerto);
        if (ass.name) {
          $("input[name=name]").val(ass.name);
          $("input[name=planets]").val(ass.moderators);
          $("input[name=vpass]").val(ass.vpassword);
          $("input[name=famid]").val(ass.id);
          $('input[name="planets"]').amsifySuggestags(
            {
              suggestionsAction: {
                url: path + "/sug.php",
              },
            },
            "refresh"
          );
          $("#addnewtree").modal("show");
        }
      });
      return false;
    });
  
    $("#addnewtree").on("hidden.bs.modal", function () {
      $("input[name=name]").val("");
      $("input[name=planets]").val("");
      $("input[name=vpass]").val("");
      $("input[name=famid]").val("");
      $('input[name="planets"]').amsifySuggestags(
        {
          suggestionsAction: {
            url: path + "/sug.php",
          },
        },
        "refresh"
      );
    });
  
    /** File Upload **/
    if ($("#images").length) {
      $("#images").fileinput({
        language: "en",
        uploadAsync: false,
        showZoom: false,
        uploadUrl: path + "/ajax.php?pg=upload",
        allowedFileExtensions: ["jpg", "jpeg", "bmp", "png", "gif"],
        actionZoom: false,
      });
  
      // CATCH RESPONSE
      $("#images").on("fileuploaded", function (event, data) { });
  
      $("#images").on(
        "filebatchuploadsuccess",
        function (event, data, previewId, index) {
          var dataUploaded = data.response.file_output;
          var i;
          for (i = 0; i < dataUploaded.length; i++) {
            if (dataUploaded[i].success === true) {
              $("#images").after(
                '<input type="hidden" name="images_tmp[]" value="' +
                dataUploaded[i].path +
                '" placeholder="' +
                dataUploaded[i].name +
                '"/>'
              );
            }
          }
        }
      );
    }
  
    $("#datepicker").datepicker();
  
    $(".pl-share-button").livequery("click", function () {
      var ul = $(this).parent().find("ul");
      if (ul.hasClass("open")) {
        ul.removeClass("open");
      } else {
        ul.addClass("open");
      }
    });
  
    $.barChart = function (ChartID, DataLabelss, DataCnts, DataClrs, DataTitle) {
      new Chart(document.getElementById(ChartID), {
        type: "bar",
        data: {
          labels: DataLabelss,
          datasets: [
            {
              label: DataTitle,
              backgroundColor: DataClrs,
              data: DataCnts,
            },
          ],
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: DataTitle,
          },
        },
      });
    };
  
    $.lineChart = function (DataLabelss, DataCnts, DataTitle) {
      new Chart(document.getElementById("line-chart"), {
        type: "line",
        data: {
          labels: DataLabelss,
          datasets: [
            {
              data: DataCnts,
              label: false,
              borderColor: "#5f90fa",
              backgroundColor: "rgba(95, 144, 250, 0.65)",
            },
          ],
        },
        options: {
          legend: {
            display: false,
          },
          title: {
            display: true,
            text: DataTitle,
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  autoSkip: false,
                  maxRotation: 40,
                  minRotation: 40,
                },
              },
            ],
          },
        },
      });
    };
  
    if ($(".pt-adminstats").length) {
      $.get(path + "/ajax.php?pg=adminstats&request=daily", function (puerto) {
        var ass = JSON.parse(puerto);
        var DataLabelss = ass.labels;
        var DataCnts = ass.data;
        var DataTitle = ass.title;
        $.lineChart(DataLabelss, DataCnts, DataTitle);
      });
  
      $.get(
        path + "/ajax.php?pg=adminstatsbars&request=daily",
        function (puerto) {
          var ass = JSON.parse(puerto);
          var DataLabelss = ass.labels;
          var DataCnts = ass.data;
          var DataTitle = ass.title;
          var DataClrs = ass.colors;
  
          $.barChart("bar-chart", DataLabelss, DataCnts, DataClrs, DataTitle);
        }
      );
  
      $(".pt-adminlines a").on("click", function () {
        var t = $(this).attr("href").replace("#", "");
        var ids = $(this).attr("rel");
        $.get(path + "/ajax.php?pg=adminstats&request=" + t, function (puerto) {
          var ass = JSON.parse(puerto);
          var DataLabelss = ass.labels;
          var DataCnts = ass.data;
          var DataTitle = ass.title;
  
          $.lineChart(DataLabelss, DataCnts, DataTitle);
        });
        return false;
      });
  
      $(".pt-adminbars a").on("click", function () {
        var t = $(this).attr("href").replace("#", "");
        var ids = $(this).attr("rel");
        $.get(
          path + "/ajax.php?pg=adminstatsbars&request=" + t,
          function (puerto) {
            var ass = JSON.parse(puerto);
            var DataLabelss = ass.labels;
            var DataCnts = ass.data;
            var DataTitle = ass.title;
            var DataClrs = ass.colors;
  
            $.barChart("bar-chart", DataLabelss, DataCnts, DataClrs, DataTitle);
          }
        );
        return false;
      });
    }
  
    //####################################
    //#####                          #####
    //#####     6) User Details      #####
    //#####                          #####
    //####################################
  
    $("#chooseFile").bind("change", function () {
      var filename = $("#chooseFile").val();
      if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass("active");
        $("#noFile").text(lang.alerts.nofile);
      } else {
        $(".file-upload").addClass("active");
        $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
      }
    });
  
    //- Image Upload
  
    $("#dropZone").imageUploader({
      fileField: "#chooseFile",
      urlField: "#url",
      hideFileField: false,
      hideUrlField: false,
      url: path + "/ajax.php?pg=imageupload",
      thumbnails: {
        div: "#thumbnails",
        crop: "zoom",
        width: 150,
        height: 150,
      },
      afterUpload: function (data) {
        console.log("after upload", data);
        $("[name=reg_photo]").val(data);
      },
      onFileAdded: function (file) {
        console.log(file);
      },
      onFilesSelected: function () {
        console.log("file selected");
      },
      onUrlSelected: function () {
        console.log("url selected");
      },
      onDragStart: function (event) {
        console.log(event);
      },
      onDragEnd: function (event) {
        console.log(event);
      },
      onDragEnter: function (event) {
        console.log(event);
      },
      onDragLeave: function (event) {
        console.log(event);
      },
      onDragOver: function (event) {
        console.log(event);
      },
      onDrop: function (event) {
        console.log(event);
      },
      onUploadProgress: function (event) {
        console.log(event);
      },
      beforeUpload: function () {
        console.log("before upload");
        $("#thumbnails").html("");
        return true;
      },
      error: function (msg) {
        alert(msg);
      },
    });
  
    $("#user-send-details").livequery("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=user-send-details",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.msg, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.msg, "red");
          }
        },
        "json"
      );
  
      return false;
    });
  
    $("#send-reset-password").on("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=resetpassword",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            setTimeout(function () {
              $(location).attr("href", path + "/index.php");
            }, 3000);
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $("#password-reset").on("submit", function () {
      var th = $(this);
      $.post(
        path + "/ajax.php?pg=sendpassword",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            setTimeout(function () {
              $(location).attr("href", path + "/index.php");
            }, 3000);
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $(".pt-sendsettings").on("submit", function () {
      $.post(
        path + "/ajax.php?pg=sendsettings",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $(".pt-sendlanguage").on("submit", function () {
      $.post(
        path + "/ajax.php?pg=sendlanguage",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $(".pt-sendpage").livequery("submit", function () {
      $.post(
        path + "/ajax.php?pg=sendpage",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $("#sendplans").livequery("submit", function () {
      $.post(
        path + "/ajax.php?pg=sendplans",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.alert, "green");
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $(".sendpaypalplan").livequery("submit", function () {
      $.post(
        path + "/ajax.php?pg=sendpaypalplan",
        $(this).serialize(),
        function (puerto) {
          if (puerto.type == "success") {
            $.puerto_confirm(lang.success, puerto.alert, "green");
            $(location).attr("href", puerto.url);
          } else {
            $.puerto_confirm(lang.error, puerto.alert, "red");
          }
        },
        "json"
      );
      return false;
    });
  
    $("li").prev("br").remove();
    $("li").next("br").remove();
  
    //- Wysibb Editor
    if ($("#wysibb-editor").length) {
      var textarea = document.getElementById("wysibb-editor");
      sceditor.create(textarea, {
        format: "bbcode",
        style: path + "/js/minified/themes/content/default.min.css",
        emoticonsRoot: path + "/js/minified/",
        height: 400,
        toolbarExclude:
          "indent,outdent,email,date,time,ltr,rtl,print,subscript,superscript,table,code,quote,emoticon",
        icons: "material",
      });
      var body = sceditor.instance(textarea).getBody();
      sceditor.instance(textarea).keyUp(function (e) {
        var val = sceditor.instance(textarea).val();
        sceditor.instance(textarea).updateOriginal();
      });
    }
  
    $(".userstatus").on("change", function () {
      $.post(
        path + "/ajax.php?pg=userstatus",
        { status: $(this).is(":checked"), value: $(this).val() },
        function (puerto) { }
      );
    });
  
    $(".familystatus").on("change", function () {
      $.post(
        path + "/ajax.php?pg=familystatus",
        { status: $(this).is(":checked"), value: $(this).val() },
        function (puerto) {
          console.log(puerto);
        }
      );
    });
  
    $(".pt-delete").on("click", function () {
      var th = $(this);
      if (confirm("are you sure you want to delete?")) {
        $.get(
          path +
          "/ajax.php?pg=delete&id=" +
          $(this).data("id") +
          "&request=" +
          $(this).data("request"),
          function (puerto) {
            th.parent().parent().parent().parent().fadeOut();
          }
        );
      }
      return false;
    });
  
    if ($(".my").length) {
      $(".my").iconpicker({ placement: "bottom" });
    }
  
    $(".show-more a").on("click", function () {
      var $this = $(this);
      var $content = $this.parent().prev("div.content");
      var linkText = $this.text().toUpperCase();
  
      if (linkText === "XEM THÊM") {
        linkText = "thu gọn";
        $content.toggleClass("hideContent showContent", 400);
      } else {
        linkText = "Xem thêm";
        $content.toggleClass("showContent hideContent", 400);
      }
  
      $this.html(linkText);
    });
  
    $("#spinResetPassword").hide();
  
    $("#btnResetPassword").click(function () {
      $("#spinResetPassword").show();
      setTimeout(function () {
        $("#spinResetPassword").hide();
      }, 7000);
    });
  
    $("#mobile").click(function () {
      var x = $(".primary-menu")[0];
      $(x).toggleClass("menu-show");
      var sub = $(".submenu");
      for (var i = 0; i < sub.length; i++) {
        $(sub).addClass("no-position");
      }
    });
  
    var treeInvite = $(".tree-invite");
    for (var iinvite = 0; iinvite < treeInvite.length; iinvite++) {
      $(treeInvite[iinvite]).click(function () {
        var x = $(".pt-edit")[0];
        x.click();
      });
    }
  
    /*use this js if your element width is unlimited an you want to scroll in a 
    constant speed. else, you dont need this js code*/
    var elemWidth = document.getElementById("scroll-element").offsetWidth;
            var time = elemWidth / 40; /* 30 = scrolling speed (44px/s)*/
            document.getElementById("scroll-element").style.cssText =
              "animation: scroll " + time + "s linear infinite;";


            $("#enterEmail").click(function () {
              var xsug = $('.amsify-suggestags-input')
              xsug.accessKey = 'enter'

            })
    
    
  })(jQuery);
  
  