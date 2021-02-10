
function  show_erea(){
  const select = document.querySelectorAll('.display'); //.classList.remove('hidden');
  // document.getElementById('canva').classList.add('hiddenBtn');
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
}

function  hidden_erea(){
  const select = document.querySelectorAll('.display'); //.classList.remove('hidden');
  // document.getElementById('canva').classList.remove('hiddenBtn');
  select.forEach(function(elem){
    elem.classList.add('hiddenBtn');
  });
}

function  camera_on(){
  
  const video = document.getElementById('video');
  var canva = document.getElementById('hidden_canva');
  // console.log(canva.height);
  
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
    // console.log(factor);
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