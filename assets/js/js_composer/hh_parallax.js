window.addEventListener('load', (e) => {
  const parallaxes = document.querySelectorAll('[data-hh-parallax]');
  let scrlPercent, scrlOffset, scrlHeight, winHeight, winWidth, docHeight
  resize();

  function resize(){
    docHeight = document.body.clientHeight;
    winHeight = window.innerHeight;
    winWidth = window.innerWidth;
    scrlHeight = docHeight - winHeight;
    loop();
  }

  parallaxes.forEach((el,i) => {
    const parImg = document.createElement('img');
    el.parStart = (el.offsetTop - el.offsetHeight - 50) / docHeight;
    el.parEnd = (el.offsetTop + winHeight + el.offsetHeight - 100) / docHeight;
    el.parSpeed = el.getAttribute('data-hh-parallax');
    el.parTarget; el.parCurrent;
    parImg.setAttribute('src',el.getAttribute('data-vc-parallax-image'));
    parImg.setAttribute('style','position: absolute; left: 0; top: '+ (((el.parSpeed < 0) && '0%') || '-100%') + '; width: 100%; z-index: 0;');
    el.appendChild(parImg);
    console.log(el.offsetTop,winHeight,el.offsetHeight,docHeight)
  });

  function update(){
    parallaxes.forEach((el,i) => {
      if (scrlPercent <= el.parStart) {
        el.parTarget = 0.001;
      } else if (scrlPercent >= el.parEnd){
        el.parTarget = el.parSpeed*el.offsetHeight*el.parEnd;
      } else {
        el.parTarget = (el.parSpeed*winHeight*(scrlPercent-el.parStart))
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
    console.log(scrlPercent);
  }

  window.addEventListener('resize',function(){
    if (winWidth !== window.innerWidth) {
      resize();
    }
  });
})
