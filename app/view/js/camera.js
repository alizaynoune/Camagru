
// window.addEventListener('load', function () {
//   add_event();
// })
var   captur = 0;


function  show_erea(){
  const select = document.querySelectorAll('.display');
  //   remove_event(document.querySelector('.event'));
  delete_event(document.getElementById('canva'));
  // document.querySelector('#canva').classList.remove('event');
  // document.querySelector('#video').classList.add('event');
  // add_event(document.querySelector('#video'));
  // document.querySelector('#hidden_canva').style.display = 'inline-block';
  // document.querySelector('#canva').style.display = 'none';
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
}

function  hidden_erea(){
  const select = document.querySelectorAll('.display');
  if (captur === 0)
    new_event(document.getElementById('canva'));
  // document.querySelector('#canva').classList.add('event');
  // document.querySelector('#video').classList.remove('event');
  // add_event(document.querySelector('#canva'));
  // document.querySelector('#hidden_canva').style.display = 'none';
  // document.querySelector('#canva').style.display = 'inline-block';
  
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
  if (event.target.files[0]){
    img.src = URL.createObjectURL(event.target.files[0]);
    captur = 0;
    new_event(canva);
  }
  
}

function    capture_img(){
  captur = 1;
  var canva = document.getElementById('canva');
  var video = document.getElementById('video');
  canva.width = video.videoWidth;
  canva.height = video.videoHeight;
  canva.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
}

function    drag(ev){
  ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.effectAllowed = "copy";
  
}

function   drop(ev){
  // event.preventDefault();
  // console.log('drop');
  
}


function      dragover(ev){

}

function    ondraging(event){
  // console.log('ondrag');
  
}

function    _event(targ){
  // console.log(targ);
  console.log(targ.screenX + ' ' + targ.screenY);
  
}

function    new_event(targ){
  targ.addEventListener('dragover', _event);
}

function    delete_event(targ){
  targ.removeEventListener('dragover', _event);
  // console.log('test');
  
}