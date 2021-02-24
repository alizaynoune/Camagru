
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
  // document.getElementById('vi')
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
  // fix_size(size.offsetWidth, size.offsetHeight, document.getElementById('video'));
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
      // fix_size(size.offsetWidth, size.offsetHeight, document.getElementById('video'));
      video.srcObject = stream;
      clear_stickers(document.getElementById('canva_id'));
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
    // console.log(size.offsetWidth);
    canva.height = canva.width;
    clear_stickers(size);
    var factor = Math.min((canva.width / img.width), (canva.height / img.height));
    // if (factor < 1)
    //   factor *= 1.5;
    // console.log(canva.height);
    
    canva.height = img.height * factor;
    canva.width = img.width * factor;
    ctx.drawImage(img, 0, 0, canva.width, canva.height);
    // fix_size(canva.width, canva.height, document.getElementById('canva_id'));
    // console.log(canva.height);
  };
  if (event.target.files[0]){
    img.src = URL.createObjectURL(event.target.files[0]);
    captur = 0;
    new_event(document.getElementById('canva'));
  }
  
}

function    capture_img(){
  captur = 1;
  var canva = document.getElementById('canva');
  var video = document.getElementById('video');
  canva.width = video.videoWidth;
  canva.height = video.videoHeight;
  clear_stickers(document.getElementById('canva_id'));
  clear_stickers(document.getElementById('video_id'));
  canva.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
  // fix_size(canva.width, canva.height, document.getElementById('canva_id'));
}




function    drag(ev){
  ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.effectAllowed = "copy";
  
}

// function    fix_size(x, y, elem){
//   console.log(x / 4);
//   elem.style.width = `${x}xp`;
//   elem.style.height = `${y}xp`;
  
// }

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
  const elem = document.getElementById(id);
  // console.log(elem);
  if (elem !== null){
    var cln = elem.cloneNode(true);
    // let x = (event.offsetX) - (elem.offsetWidth / 2);
    // let y = (event.offsetY) - (elem.offsetHeight / 2) ;
    let x =  event.offsetX - (elem.offsetWidth / 3);
    let y =  event.offsetY - event.target.clientHeight - (elem.offsetHeight / 2);
    // x = x < 0 ? (elem.offsetWidth / 4) : x;
    // y = y < 0 ? (elem.offsetHeight / 4) : y;
    // cln.removeAttribute('id');
    cln.id = 'copy';
    cln.style.transform = `translate(${x}px, ${y}px)`;
    event.path[1].appendChild(cln);
    console.log(x + ' ' + y);
    console.log(event.target.clientWidth + ' ' + event.target.offsetHeigh);
    
    console.log(event);
    
    // console.log(ui);
    
    // event.dataTransfer.clearData();
  }
  // console.log(elem.src);
  
  
  
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

function    clear_stickers(elem){
  // let canva = document.getElementById('canva_id');
  // let video = document.getElementById('video_id');
  elem.childNodes.forEach((e)=>{
    if (e.id === 'copy')
      e.remove();
      // console.log(e);
    
  });

}

document.querySelector('.stickers').childNodes.forEach((e)=>{
  // console.log(e);
  e.addEventListener('drag', ondraging);
  e.addEventListener('dragstart', dragstart);
  // e.addEventListener('draggable', ev => {}, true);
  
});

