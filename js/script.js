var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var width = window.innerWidth;
var height = window.innerHeight;
var x = window.innerWidth/2;
var y = window.innerHeight/2;
var ballX = x;
var ballY = y;
resize();

// Récupérer les boutons du DOM

let firstButton = document.getElementById('firstButton');
let secondButton = document.getElementById('secondButton');
let container = document.getElementsByClassName('container');
let backgroundColor = document.getElementsByClassName('background');
let firstButtonAnswers = document.getElementsByClassName('firstButtonAnswers');
let secondButtonAnswers = document.getElementsByClassName('secondButtonAnswers');
let image = document.getElementById('img');


function drawBall() {
  ctx.beginPath();
  // instead of updating the ball position to the mouse position we will lerp 10% of the distance between the balls current position and the mouse position.
  ballX += (x - ballX)*0.1;
  ballY += (y - ballY)*0.1;
  ctx.arc(ballX, ballY, 30, 0, 2*Math.PI);
  ctx.fill();
}


// Drawball color
ctx.fillStyle = '#BEE8FB';

function loop() {
  ctx.clearRect(0, 0, width, height);
  drawBall();
  requestAnimationFrame(loop);
}

loop();

function touch(e) {
  x = e.originalEvent.touches[0].pageX;
  y = e.originalEvent.touches[0].pageY;
}

function mousemove(e) {
  x = e.pageX;
  y = e.pageY;
}

function resize() {
  width = canvas.width = window.innerWidth;
  height = canvas.height = window.innerHeight;
}

window.addEventListener('resize', resize);
window.addEventListener('touchstart', touch);
window.addEventListener('touchmove', touch);
window.addEventListener('mousemove', mousemove);


// Changer la couleur au click
// Création fonction

function getFirstColor(){
    for ( i = 0 ; i < container.length ; i++ ) {
          container[i].classList.toggle('active');
          backgroundColor[i].classList.toggle('active');
          firstButtonAnswers[i].classList.toggle('active');
          if (container[i].classList.contains("active"))
          {
            image.style.display = 'none';
            ctx.fillStyle = '#98FB98	';
          }
          else 
          {
            image.style.display ='block';
            ctx.fillStyle = '#BEE8FB';
          }
    }
}

function getSecondColor(){
    for ( i = 0 ; i < container.length ; i++ ) {
        container[i].classList.toggle('active2');
        backgroundColor[i].classList.toggle('active2');
        secondButtonAnswers[i].classList.toggle('active2');
        if (container[i].classList.contains("active2"))
        {
          image.style.display = 'none';
          ctx.fillStyle = '#FFE4C4';
        }
        else 
        {
          image.style.display ='block';
          ctx.fillStyle = '#BEE8FB';
        }
  }
}

// Appel fonction
firstButton.addEventListener('click',getFirstColor);
secondButton.addEventListener('click',getSecondColor);


