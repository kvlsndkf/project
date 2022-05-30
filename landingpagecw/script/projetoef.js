document.addEventListener('DOMContentLoaded', () => {
    var tl = gsap.timeline();

    tl
      .from(".menu-1", {
        duration: 1,
        y: 50,
        opacity: 0,
        delay: 0.5,
        ease: "power3.out",
      })
      .from(".menu-2", {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")
      .from(".menu-3", {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")
      .from(".menu-4", {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")
      .from(".menu-5", {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")
      .from(".container-item div", {
        duration: 1,
        y: 300,
        opacity: 0,
        stagger: { each: 0.2 },
        ease: "power3.out",
      }, "-=0.8")
      .from(".container-item img", {
        duration: 1,
        y: 300,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")
      .from(".bg-hero", {
        duration: 1,
        y: 300,
        opacity: 0,
        ease: "power3.out",
      }, "-=0.8")


    gsap.registerPlugin(ScrollTrigger);

    gsap.from("#section-01 div", {
      duration: 1,
      y: 300,
      opacity: 0,
      stagger: { each: 0.2 },
      ease: "power3.out",
      scrollTrigger: {
        trigger: "#section-01",

      }
    });

    gsap.from("#section-02 div", {
      duration: 1,
      y: 300,
      opacity: 0,
      stagger: { each: 0.2 },
      ease: "power3.out",
      scrollTrigger: {
        trigger: "#section-02",

      }
    });
  })


  
  function createBall(ballSize) {
  const positionX = Math.floor(Math.random() * (window.innerWidth - ballSize))
  const positionY = Math.floor(Math.random() * (window.innerHeight - ballSize))

  const ballHtml            = document.createElement('div')
  ballHtml.className        = 'ball'
  ballHtml.style.width      = ballSize + 'px'
  ballHtml.style.height     = ballSize + 'px'
  ballHtml.style.left       = positionX + 'px'
  ballHtml.style.top        = positionY + 'px'

  const signX = Math.floor(Math.random() * 2) === 1 ? 1 : -1
  const signY = Math.floor(Math.random() * 2) === 1 ? 1 : -1

  return {
    positionX,
    positionY,
    vectorX: Math.floor((Math.random() * 5) + 1) * signX,
    vectorY: Math.floor((Math.random() * 3) + 1) * signY,
    size   : ballSize,
    html   : ballHtml,
  }
}

function moveBalls(balls) {
  for (const ball of balls) {
    if (ball.positionX + ball.size > window.innerWidth || ball.positionX < 0) ball.vectorX = -ball.vectorX
    if (ball.positionY + ball.size > window.innerHeight || ball.positionY < 0) ball.vectorY = -ball.vectorY

    ball.positionX += ball.vectorX
    ball.positionY += ball.vectorY

    ball.html.style.left = ball.positionX + 'px'
    ball.html.style.top  = ball.positionY + 'px'
  }
}

// Starting Point
(function main() {
  const maxBallsToCreate = 6
  const ballSize         = 150

  const ballCreationSpeed   = 1 // ms
  const ballMoveRefreshRate = 45 // ms

  let timeElapsed = 0
  const balls     = []

  

  // Ball Creation
  const createBallIntervalId = setInterval(function () {
    if (balls.length === maxBallsToCreate) {
      clearInterval(timerIntervalId)
      clearInterval(createBallIntervalId)
      return
    }

    const ball = createBall(ballSize)
    balls.push(ball)

    document.body.appendChild(ball.html)
    document.getElementById('ball-count').innerText = `${balls.length}`
  }, ballCreationSpeed)

  // Ball Movement
  setInterval(function () {
    moveBalls(balls)
  }, ballMoveRefreshRate)

  // Page Reload on Window Resize
  window.onresize = function () {
    location.reload()
  }
})()
