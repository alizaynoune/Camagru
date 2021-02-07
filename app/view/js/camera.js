

function  camera_on(){
  const video = document.getElementById('video');

  const constraints = {
    video: true,
    audio: false,
  };
  
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      video.srcObject = stream;
    });
}

function  camera_off(){
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