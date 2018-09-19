// the most awesome mob menu
$(document).ready(function(){
  let $activeSub;
  let $clckParent;
  let subSiblings;
  let resizeTimer;
  let scrollTimer;
  const $window = $(window);
  const $mobMenu = $('.header-mobile');
  $('#menu-main-menu-1 .im-chevron-down').each(function(i,el){
    $(el).click(function(i){
      $clckParent = $(el).parent('.menu-item');
      if ($activeSub){
        if ($activeSub.is($clckParent)){
          hideSub();
        } else {
          showSub(true);
        }
      } else {
        showSub();
      }
    })
  })
  $('.mob-trigger').click(()=>{
    if ($mobMenu.is(':visible') && $activeSub){
      hideSub();
    }
    $mobMenu.slideToggle(200)
  })
  $window.resize(()=>{
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(()=>{
      if ($window.width() > 767 && $mobMenu.is(':visible')){
        $activeSub && hideSub();
        $mobMenu.slideToggle(200);
      }
    },100);
  })
  $window.scroll(()=>{
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(()=>{
      if ($window.width() < 768 && $mobMenu.is(':visible') && $window.scrollTop() > 700) {
        $activeSub && hideSub();
        $mobMenu.slideToggle(200);
      }
    },200)
  })
  function hideSub(){
    $activeSub.children('.sub-menu').fadeToggle(200);
    $activeSub.removeClass('active-sub');
    $activeSub = undefined;
  }
  function showSub(und = false){
    if (und){
      $activeSub.children('.sub-menu').fadeToggle(100);
      $activeSub.removeClass('active-sub');
    }
    $activeSub = $clckParent;
    $activeSub.addClass('active-sub');
    $activeSub.children('.sub-menu').delay(100).fadeToggle(100);
  }
})
