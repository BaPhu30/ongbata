

// tab-section

// Select show tab on load page
let indexOpen = 0;

let btnTab = document.querySelectorAll('.nav-tab .ul_tab .li_tab .button_tab');
let contentTab = document.querySelectorAll('.content-tab');

function tabCurrent(thisTab) {
  let idCurrent = thisTab.dataset.tab;

  for (let i = 0; i < btnTab.length; i++) {
    btnTab[i].classList.remove('tab-current');
  }
  thisTab.classList.add('tab-current');

  for (let i = 0; i < contentTab.length; i++) {
    if (idCurrent === contentTab[i].id) {
      contentTab[i].classList.add('current-content-tab');
    } else {
      contentTab[i].classList.remove('current-content-tab');
    }
  }
}

for (let i = 0, len = btnTab.length; i < len; i++) {
  btnTab[i].onclick = function () {
    tabCurrent(this);
  }
}

tabCurrent(btnTab[indexOpen]);

// like
function openToggle(evt) {
  $(document).ready(function () {
    var countlike = 0;
    var idpost = $(evt).attr('data-id');
    var authorid = $(evt).attr('data-user');
    var likepost = {
      author:authorid,
      likepostid: idpost,
      method: 'likepost'
    }
    countlikehtml = $(evt).closest(".section_right-2_footer").find(".coutlike").get(0);
    countlike = $(countlikehtml).text().trim();
    if(countlike > 0){ countlike = countlike} else { countlike = 0 }
    console.log(countlikehtml);
    $.ajax({
      url: '../Process/Post.php',
      type: 'POST',
      data: likepost,
      dataType: 'json',
      cache: false,
      success: function (data) {
        if (data.success == true) {
          if(data.name == 'like') {
            evt.classList.toggle("liked")
            countlike = parseInt(countlike) + 1;
            $(countlikehtml).html(countlike)

          } else {
            countlike = parseInt(countlike) - 1;
            $(countlikehtml).html(countlike)
            evt.classList.toggle("liked")
          }
        } else {
          alert(data.name)
        }
      }
    })
  })


}
// khu toggle
function openCommentdad(commentName) {
  $(document).ready(function () {
    var cmt = $(commentName).parent().parent().parent();
    var evt = $(cmt).find(".comment_nt_click")[0];
    evt.classList.toggle("click_commnet");
  });
}
// son comment
function openCommentson(evt, commentsonName) {
  var evt = document.getElementById(commentsonName);
  evt.classList.toggle("form_toggle_son")
}

function openTabson(evt, tabName) {
  var i, tabcontent_2, tablinks;
  tabcontent_2 = document.getElementsByClassName("tabcontent_2");
  for (i = 0; i < tabcontent_2.length; i++) {
    tabcontent_2[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active_2", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active_2";
}

// khu video
var supportsES6 = function () {
  // https://gist.github.com/bendc/d7f3dbc83d0f65ca0433caf90378cd95
  try {
    new Function("(a = 0) => a");
    return true;
  }
  catch (err) {
    return false;
  }
}();



$(".kiem_tra:contains(Nam)");
  $(".ic").parent().addClass("fa-mars");


  $(".kiem_tra:contains(Nữ)");
  $("this").addClass("fa-venus");
  // 

  $(document).ready(function () {

   

  
    
    
    $(".bt_them_bai_viet").click(function(){
      $(".editor").focus();     

    });
    
   
     
      

      $("img[src='']").parent().parent().remove()
      $("source[src='']").parent().parent().remove()
      $(".read-m").click(function(){
          $(this).parent().parent().toggleClass("pr_da");
      });
      $(".xoa_dulieu").remove();
                       
     
      $(".cancel_post").click(function () {
        $('#them_bai_viet').modal('hide');
        $('#AddPos').val("");
        $('.ck-content').html('');
        $('.preview li').remove();
        
    });
      
  // Get the modal
    

    // Get the <span> element that closes the modal
    

    // When the user clicks the button, open the modal 
    $(".click_login").click(function () { 
      $('#Modal_login').css("display", "block");
    });
    
    // When the user clicks on <span> (x), close the modal
    $(".close-login,.modal-login").click(function () { 
      $('#Modal_login').css("display", "none");
    });
  

    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }
    
  });
  
// /khu comment
