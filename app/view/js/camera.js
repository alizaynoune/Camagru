
function  show_erea(){
  const select = document.querySelectorAll('.display'); //.classList.remove('hidden');

  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
}

function  hidden_erea(){
  const select = document.querySelectorAll('.display'); //.classList.remove('hidden');

  select.forEach(function(elem){
    elem.classList.add('hiddenBtn');
  });
}

function  camera_on(){
  show_erea();
  const video = document.getElementById('video');
  const constraints = {
    video: true,
    audio: false,
  };
  
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      stream.height = video.style.height;
      stream.width = video.style.width;
      video.srcObject = stream;
      console.log(video.style);
      
    })
    .catch(err => {
      console.log(err);
    });
}

function  camera_off(){
  hidden_erea();
  const video = document.getElementById('video');
  const mediaStream = video.srcObject;
  const tracks = mediaStream.getTracks();
  tracks.forEach(function(track) {
    track.stop();
  });

  video.srcObject = null;
}

function  control_camera(elem){
  if (elem.checked === true)
    camera_on();
  else
    camera_off();
}

function    upload_to_canva(event){
  // console.log('done');
  var canva = document.getElementById('canva');
  var ctx = canva.getContext('2d');
  var img = new Image();
  img.onload = function(){
    // if (img.width > canva.width){
    //   canva.width = (img.width / 2);
    //   canva.height = (img.height / 2);
    // }
    // else if (canva.width > img.width){
    // }
    // canva.width = ((img.width / 2) - canva.width) / 2;
    // canva.height =((img.height / 2) - canva.height) / 2;
    // canva.height -= (img.width - img.height);
    // canva.width -= (img.height - img.width);
    ctx.drawImage(img, 0, 0, canva.width, canva.height);
    
    console.log(img.width);
    console.log(img.height);
    
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