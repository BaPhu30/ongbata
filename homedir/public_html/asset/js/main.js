// move modal dialog
$('.modal-dialog').draggable({
  handle: ".modal-header"
});

// stop hide dropdown when click inside dropdown
$(document).on('click', '.header_nav .dropdown-menu', function (e) {
  e.stopPropagation();
});

// close accessibility menu
$('.accessibility_close_btn').click(function () {
  $('.accessibility_menu').toggleClass('show')
})

// onscroll event
document.onscroll = function () {
  // community section backgroundColor
  var community = document.querySelector('.community_section')
  if (community.offsetTop - window.scrollY < 400) {
    community.style.backgroundColor = '#f7f7f7'
  } else {
    community.style.backgroundColor = '#a9d0d2'
  }

  // devices animation
  var devices = document.querySelectorAll('.device_item, .start_free_trial_btn')
  for (var device of devices) {
    let x = device.offsetTop - window.scrollY - 300;
    let y = x > 0 ? x : 1;
    let a = 300 / y;
    let b = a > 1 ? 1 : a < 0.3 ? 0.3 : a;
    device.style.transform = 'scale(' + b + ')';
    device.style.opacity = b;
  }

  // family animation
  var familyItems = document.querySelectorAll('.father_parents, .father, .mother')
  var treeChart = document.querySelector('.tree_chart')
  for (var familyItem of familyItems) {
    var familyItemY = familyItem.offsetTop + treeChart.offsetTop;
    let x = familyItemY - window.scrollY - 100;
    let y = x > 0 ? x : 0;
    let a = 300 / y;
    let b = a > 1 ? 1 : a < 0 ? 0 : a;
    familyItem.style.transform = 'scale(' + b + ')';
    familyItem.style.opacity = b;
  }

  // records animation
  {
    var records = document.querySelectorAll('.record_item')
    var recordsAnimation = document.querySelector('.records_animation')
    let x = recordsAnimation.offsetTop - window.scrollY;
    let y = x > 0 ? x : 1;
    let a = 200 / y;
    let b = a > 1 ? 1 : a < 0.3 ? 0.3 : a;
    records[0].style.left = -680 * b - 150 + 150 * b + 'px';
    records[1].style.left = -460 * b - 150 + 150 * b + 'px';
    records[2].style.left = -330 * b - 150 + 150 * b + 'px';
    records[3].style.left = -60 * b - 150 + 150 * b + 'px';
    records[4].style.left = 40 * b - 150 + 150 * b + 'px';
    records[5].style.left = 170 * b - 150 + 150 * b + 'px';
    records[6].style.left = 370 * b - 150 + 150 * b + 'px';
  }

  // records animation
  {
    var boxItems = document.querySelectorAll('.box_item')
    var discoveryAnimation = document.querySelector('.discovery_section')
    let x = discoveryAnimation.offsetTop - window.scrollY -100;
    let y = x > 0 ? x : 1;
    let a = 200 / y;
    let b = a > 1 ? 1 : a < 0 ? 0 : a;
    boxItems[4].style.left = 10 * b - 50 + 50 * b + 'px';
    boxItems[5].style.left = 2 * b - 50 + 50 * b + 'px';
    boxItems[6].style.left = 10 * b - 50 + 50 * b + 'px';
    boxItems[7].style.left = -163 * b - 50 + 50 * b + 'px';
    boxItems[8].style.left = -207 * b - 50 + 50 * b + 'px';
    boxItems[9].style.left = -132 * b - 50 + 50 * b + 'px';
    boxItems[10].style.left = -60 * b - 50 + 50 * b + 'px';
    boxItems[11].style.left = -194 * b - 50 + 50 * b + 'px';
    boxItems[12].style.left = -206 * b - 50 + 50 * b + 'px';
    boxItems[13].style.left = -65 * b - 50 + 50 * b + 'px';
    boxItems[14].style.left = 114 * b - 50 + 50 * b + 'px';
    boxItems[15].style.left = 165 * b - 50 + 50 * b + 'px';
    boxItems[16].style.left = 157 * b - 50 + 50 * b + 'px';

    boxItems[4].style.top = 43 * b + 150 - 150 * b + 'px';
    boxItems[5].style.top = -25 * b + 150 - 150 * b + 'px';
    boxItems[6].style.top = -68 * b + 150 - 150 * b + 'px';
    boxItems[7].style.top = -66 * b + 150 - 150 * b + 'px';
    boxItems[8].style.top = -9 * b + 150 - 150 * b + 'px';
    boxItems[9].style.top = -126 * b + 150 - 150 * b + 'px';
    boxItems[10].style.top = -149 * b + 150 - 150 * b + 'px';
    boxItems[11].style.top = 145 * b + 150 - 150 * b + 'px';
    boxItems[12].style.top = -35 * b + 150 - 150 * b + 'px';
    boxItems[13].style.top = 19 * b + 150 - 150 * b + 'px';
    boxItems[14].style.top = -106 * b + 150 - 150 * b + 'px';
    boxItems[15].style.top = 10 * b + 150 - 150 * b + 'px';
    boxItems[16].style.top = 58 * b + 150 - 150 * b + 'px';
  }
}

