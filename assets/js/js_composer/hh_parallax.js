window.addEventListener('load', (e) => {
  const parallaxes = document.querySelectorAll('[data-hh-parallax]');
  let scrlPercent, scrlOffset,resizeTimer;
  let docHeight = document.body.clientHeight;
  let winHeight = window.innerHeight;
  let winWidth = window.innerWidth;
  // let headerHeight = document.querySelector('header').offsetHeight;
  let scrlHeight = docHeight - winHeight;
  loop()

  function resize(){
    docHeight = document.body.clientHeight;
    winHeight = window.innerHeight;
    winWidth = window.innerWidth;
    headerHeight = document.querySelector('header').offsetHeight;
    scrlHeight = docHeight - winHeight;
    parallaxes.forEach((el,i)=>{
      el.parStart = (el.offsetTop - winHeight) / scrlHeight;
      el.parEnd = (el.offsetTop + el.offsetHeight) / scrlHeight;
      let elImg = el.querySelector('img');
      if (winWidth < 1200){
        elImg.style.left = 'calc(100% - 1200px)';
        elImg.style.width = '1200px';
      } else {
        elImg.style.width = '100%';
        elImg.style.left = '0';
      }
    })
    loop();
  }

  parallaxes.forEach((el,i) => {
    el.parStart = (el.offsetTop - winHeight) / scrlHeight;
    el.parEnd = (el.offsetTop + el.offsetHeight) / scrlHeight;
    el.parSpeed = el.getAttribute('data-hh-parallax');
    el.parTarget; el.parCurrent;
    const parImg = document.createElement('img');
    parImg.setAttribute('src',el.getAttribute('data-vc-parallax-image'));
    parImg.setAttribute('style','position: absolute; left: 0; top: '+ (((el.parSpeed < 0) && '0%') || '-100%') + '; width: 100%; z-index: 0;');
    el.appendChild(parImg);
  });

  function update(){
    parallaxes.forEach((el,i) => {
      if (scrlPercent <= el.parStart) {
        el.parTarget = 0.001;
      } else if (scrlPercent >= el.parEnd){
        el.parTarget = el.parSpeed*el.offsetHeight*el.parEnd;
      } else {
        el.parTarget = (el.parSpeed*winHeight*(scrlPercent-el.parStart)/(el.parEnd - el.parStart))
      }
      if(!el.parCurrent) {
        el.parCurrent = el.parTarget;
      } else {
        el.parCurrent = el.parCurrent + (el.parTarget - el.parCurrent)*0.7;
      }

      el.lastChild.style.transform = 'translate3d(0px,'+el.parCurrent+'px,0px)';
    })
  }

  function loop(){
    scrlOffset = window.pageYOffset || window.scrollTop;
    scrlPercent = scrlOffset/scrlHeight || 0;
    update();
    requestAnimationFrame(loop);
  }

  window.addEventListener('resize',function(){
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(()=>{
      if (winWidth !== window.innerWidth) {
        resize();
      }
    },200);
  });
})
