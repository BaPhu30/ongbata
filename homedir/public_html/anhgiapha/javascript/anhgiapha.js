
$(document).ready(function () {
    // nav-menu
    $("#menuname").click(function () {
        $('#submenu').toggleClass('show')
    });

    $('#menuhelp').click(function () {
        $('#submenuhelp').toggleClass('show')
    });

    // open menu mobile
    $('#open-menu-sidebar').click(function () {
        $('#menuMobile').toggleClass('sidebar-mobile-toggle')
        $('#contentAll').toggleClass('content-mobile')
    })

    // sidebar-mobile
    const sidebarList = $('.sidebar-tabs-li')
    $(sidebarList).click(function () {
        $(this).find('ul').toggleClass('show')
        $(this).find('i').toggleClass('icon-toggle-180')
    })

    //sidebar-mobile-showinfo
    const iconShow = $('.info-icon-right')
    const sidebarRight = $('.sidebar-right-list')
    const iconHide = $('.info-icon-right-hide')
    $(iconShow).click(function () {
        $(sidebarRight[$(this).attr('name')]).css({ 'left': '-100%', 'transition': '1s' })
    })
    $(iconHide).click(function () {
        $(sidebarRight).css({ 'left': '0%', 'transition': '1s' })
    })
})