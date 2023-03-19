// ====>  jquery
$(document).ready(function () {
  // nav-menu
  $("#menuname").click(function () {
    $("#submenu").toggleClass("show");
  });

  $("#menuhelp").click(function () {
    $("#submenuhelp").toggleClass("show");
  });

  //content faq
  const getQuestion = $(".question-list");
  $(getQuestion).click(function () {
    $(this).find("p").toggleClass("question-toggle");
    $(this).find("i").toggleClass("transform-icon");
  });

  // open menu mobile
  $("#open-menu-sidebar").click(function () {
    $("#menuMobile").toggleClass("sidebar-mobile-toggle");
    $("#contentAll").toggleClass("content-mobile");
  });

  // sidebar-mobile
  const sidebarList = $(".sidebar-tabs-li");
  $(sidebarList).click(function () {
    $(this).find("ul").toggleClass("show");
    $(this).find("i").toggleClass("icon-toggle-180");
  });

  //sidebar-mobile-showinfo
  const iconShow = $(".info-icon-right");
  const sidebarRight = $(".sidebar-right-list");
  const iconHide = $(".info-icon-right-hide");
  $(iconShow).click(function () {
    $(sidebarRight[$(this).attr("name")]).css({
      left: "-100%",
      transition: "1s",
    });
  });
  $(iconHide).click(function () {
    $(sidebarRight).css({ left: "0%", transition: "1s" });
  });

  // content two
  var slideBox = $(".gallery-slide-1 .gallery");
  var lengthBox = slideBox.length;
  var slideNumber = 0;

  $(".btn-next").click(function () {
    slideNumber++;
    if (slideNumber > lengthBox - 1) {
      slideNumber = 0;
    }
    $(slideBox).each(function () {
      $(this).removeClass("active-one");
    });
    $(slideBox[slideNumber]).addClass("active-one");
  });

  $(".btn-pre").click(function () {
    slideNumber--;
    if (slideNumber < 0) {
      slideNumber = lengthBox - 1;
    }
    $(slideBox).each(function () {
      $(this).removeClass("active-one");
    });
    $(slideBox[slideNumber]).addClass("active-one");
  });

  // content three
  var slideBox2 = $(".gallery-slide-2 .gallery");
  var lengthBox2 = slideBox2.length;
  var slideNumber2 = 0;
  $(".btn-next-2").click(function () {
    slideNumber2++;
    if (slideNumber2 > lengthBox2 - 1) {
      slideNumber2 = 0;
    }
    $(slideBox2).each(function () {
      $(this).removeClass("active-one");
    });
    $(slideBox2[slideNumber2]).addClass("active-one");
  });

  $(".btn-pre-2").click(function () {
    slideNumber2--;
    if (slideNumber2 < 0) {
      slideNumber2 = lengthBox2 - 1;
    }
    $(slideBox2).each(function () {
      $(this).removeClass("active-one");
    });
    $(slideBox2[slideNumber2]).addClass("active-one");
  });

  // javascript library

  // image click
  var id = ["#splide", "#splide2"];
  for (var i = 0; i < id.length; i++) {
    new Splide(id[i], {
      type: "loop",
      perPage: 3,
      autoWidth: true,
      focus: "center",
      rewind: true,
    }).mount();
  }

  var abc1 = document.querySelector("#img1");
  var abc2 = document.querySelector("#img2");
  var xyz1 =
    "https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/mot-goc-anh-khac-ve-chien-tranh-viet-nam-chup-tu-ben-thang-tran-11-111044.jpeg";
  var xyz2 =
    "https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/ttxvn_dienbienphu2.jpeg";

  deepai.setApiKey("02be0f47-7321-4995-9cca-fab07ac6cda6");
  (async function () {
    // two image top
    var resp = await deepai.callStandardApi("colorizer", {
      image: xyz1,
    });
    await deepai.renderResultIntoElement(resp, abc1);

    var resp = await deepai.callStandardApi("colorizer", {
      image: xyz2,
    });
    await deepai.renderResultIntoElement(resp, abc2);

    var imgID1 = document.getElementById("img1");
    var imgSrc1 = imgID1.querySelector("img").getAttribute("src");
    var imgID2 = document.getElementById("img2");
    var imgSrc2 = imgID2.querySelector("img").getAttribute("src");
    var img0 = ["#img1", "#img2"];
    var img1 = [
      "https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/mot-goc-anh-khac-ve-chien-tranh-viet-nam-chup-tu-ben-thang-tran-11-111044.jpeg",
      "https://datdia.s3.ap-southeast-1.amazonaws.com/2021/08/ttxvn_dienbienphu2.jpeg",
    ];
    var img2 = [imgSrc1, imgSrc2];
    for (var i = 0; i < img0.length; i++) {
      console.log(img0[i])
      slider = new juxtapose.JXSlider(
        img0[i],
        [
          {
            src: img1[i],
            credit: "Image Credit",
          },
          {
            src: img2[i],
            credit: "Image Credit",
          },
        ],
        {
          animate: true,
          showLabels: true,
          showCredits: true,
          startingPosition: "50%",
          makeResponsive: true,
        }
      );
    }
    imgID1.querySelector("img").style.display = "none";
    imgID2.querySelector("img").style.display = "none";
  })();

  var fileTag = document.getElementById("uploadImage"),
  preview = document.getElementById("oldImage"),
  newImage = document.getElementById("newImage");

  fileTag.addEventListener("change", function () {
    changeImage(this);
  });

  function changeImage(input) {
    newImage.innerHTML = ''
    var reader;

    if (input.files && input.files[0]) {
      reader = new FileReader();

      reader.onload = function (e) {
        preview.setAttribute("src", e.target.result);
        
      };

      reader.readAsDataURL(input.files[0]);
    }

  }

  $("#uploadImage").change(function () {
    
    deepai.setApiKey("59e32b5e-be38-4868-834d-d2f27481702f");
    (async function () {
      var resp = await deepai.callStandardApi("colorizer", {
        image: document.getElementById("uploadImage"),
      });
      await deepai.renderResultIntoElement(
        resp,
        document.getElementById("newImage")
      );
    })();
  });
});
