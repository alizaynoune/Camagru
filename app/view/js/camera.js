
// window.addEventListener('load', function () {
//   add_event();
// })
var   captur = 0;


function  show_erea(){
  const select = document.querySelectorAll('.display');
  //   remove_event(document.querySelector('.event'));
  delete_event(document.getElementById('canva'));
  new_event(document.getElementById('video'));
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
  show_erea();
  const video = document.getElementById('video');
  var size = document.getElementById('video_id'); 
  const constraints = {
    video: {
      width: size.offsetWidth,
      height: size.offsetHeight,
      audio: false
    }
  };
  // console.log(size.offsetHeight);
  
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      video.srcObject = stream;
      // show_erea();
    })
    .catch(err => {
      document.querySelector('.error').innerHTML = err;
      document.getElementById('checkbox').checked = false;
      hidden_erea();
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
  var size = document.getElementById('canva_id');
  var ctx = canva.getContext('2d');
  var img = new Image();
  img.onload = function(){
    canva.width = size.offsetWidth;
    console.log(size.offsetWidth);
    canva.height = canva.width;
    var factor = Math.min((canva.width / img.width), (canva.height / img.height));
    if (factor < 1)
      factor *= 1.5;
    // console.log(canva.height);
    
    canva.height = img.height * factor;
    canva.width = img.width * factor;
    ctx.drawImage(img, 0, 0, canva.width, canva.height);
    // console.log(canva.height);
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

function   dragstart(ev){
  // event.preventDefault();
  // console.log('drop');
  ev.dataTransfer.setData('text/plain', ev.target.id)
  // console.log(ev);
  
  // ev.dataTransfer.setDragImage(ev.target.id, 10, 10);
}


function      dragover(ev){

}

function    ondraging(event){
  // console.log('ondrag');
  
}

function    _onDragover(event){
  // console.log(targ);
  // console.log(event.screenX + ' ' + event.screenY);
  // dropzone.appendChild(draggableElement);
  event.preventDefault();
  
}

function    _onDrop(event){
  const id = event.dataTransfer.getData('text');
  const draggableElement = document.getElementById(id);
  // var cln = draggableElemen.cloneNode(true);
  // event.target.appendChild(cln);
  console.log(event);
  
  
  event.dataTransfer.clearData();
}

function    new_event(targ){
  targ.addEventListener('dragover', _onDragover);
  targ.addEventListener('drop', _onDrop)
}

function    delete_event(targ){
  targ.removeEventListener('dragover', _onDragover);
  targ.removeEventListener('drop', _onDrop);
  // console.log('test');
  
}