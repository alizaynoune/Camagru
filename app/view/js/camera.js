
function  show_erea(){
  const select = document.querySelectorAll('.display');
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
}

function  hidden_erea(){
  const select = document.querySelectorAll('.display');
  select.forEach(function(elem){
    elem.classList.add('hiddenBtn');
  });
}

function  camera_on(){
  
  const video = document.getElementById('video');
  var canva = document.getElementById('hidden_canva');  
  const constraints = {
    video: {
      width: canva.width,
      height: canva.height,
      audio: false
    }
  };
  
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      video.srcObject = stream;
      show_erea();
    })
    .catch(err => {
      document.querySelector('.error').innerHTML = err;
      document.getElementById('checkbox').checked = false;
    });
    document.querySelector('.error').innerHTML = '';
}

function  camera_off(){
  const video = document.getElementById('video');
  const mediaStream = video.srcObject;
  if (mediaStream !== null){
    const tracks = mediaStream.getTracks()
    tracks.forEach(function(track) {
      track.stop();
      hidden_erea();
    });
  }
  video.srcObject = null;
}

function  control_camera(elem){
  if (elem.checked === true)
    camera_on();
  else
    camera_off();
}

function    upload_to_canva(event){
  camera_off();
  document.getElementById('checkbox').checked = false;
  var canva = document.getElementById('canva');
  var ctx = canva.getContext('2d');
  var img = new Image();
  img.onload = function(){
    canva.height = canva.width;
    var factor = Math.min((canva.width / img.width), (canva.height / img.height));
    if (factor < 1)
      factor *= 1.5;
    canva.height = img.height * factor;
    canva.width = img.width * factor;
    ctx.drawImage(img, 0, 0, canva.width, canva.height);
  };
  img.src = URL.createObjectURL(event.target.files[0]);
}

function    capture_img(){
  var canva = document.getElementById('canva');
  var video = document.getElementById('video');
  canva.width = video.videoWidth;
  canva.height = video.videoHeight;
  canva.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
}

function    drag(ev){
  console.log(ev);
  // ev.dataTransfer.setData("text", ev.target.id);
  // ev.dataTransfer.effectAllowed = "copy";
  // ev.dataTransfer.setDragImage(ev.target.src, 10, 10);
  // ev.dataTransfer.setData("image/jpeg", ev.target.src);
  // console.log(ev.target.src);

  ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.effectAllowed = "copy";
  
}

function   drop(ev){
  // event.preventDefault();
  // console.log('drop');
  
}


function      dragover(ev){
  // var canvas = document.getElementById('canva');
  // var ctx = canvas.getContext("2d");
  // console.log(ctx);
  
  // ctx.lineWidth = 4;
  // ctx.moveTo(0, 0);
  // ctx.lineTo(50, 50);
  // ctx.moveTo(0, 50);
  // ctx.lineTo(50, 0);
  // ctx.stroke();

  // const dt = event.dataTransfer;
  // dt.setData("text/plain", ev.target.src);
  // dt.setDragImage(ev.target.src, 2, 2);

  // ctx.drawImage(ev.target.src);
  // ctx.drawImage(ev.target.src, ev.clientY, ev.clientX);
}

function    ondraging(event){
  // console.log('ondrag');
  
}