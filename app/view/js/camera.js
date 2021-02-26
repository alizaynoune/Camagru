
// window.addEventListener('load', function () {
//   add_event();
// })
var   captur = 0;
var   sticker_ivdeo = 0;
var   sticker_canva = 0;


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
  clear_stickers(document.getElementById('video_id'));
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
      // clear_stickers(document.getElementById('canva_id'));
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
  document.getElementById('checkbox-camera').checked = false;
  var canva = document.getElementById('canva');
  var size = document.getElementById('canva_id');
  var ctx = canva.getContext('2d');
  ctx.clearRect(0, 0, canva.width, canva.height);
  var img = new Image();
  img.onload = function(){
    canva.width = size.offsetWidth;
    // console.log(size.offsetWidth);
    canva.height = canva.width;
    // size.style.height = img.height;
    clear_stickers(document.getElementById('canva_id'));
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
  let box = document.getElementById('checkbox-stickers').checked;
  console.log(box);
  
  if (sticker_ivdeo === 1 || box === false){
    captur = 1;
    var canva = document.getElementById('canva');
    var video = document.getElementById('video');
    canva.width = video.videoWidth;
    canva.height = video.videoHeight;
    clear_stickers(document.getElementById('canva_id'));
    
    canva.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
    // fix_size(canva.width, canva.height, document.getElementById('canva_id'));
    copy_stickers();
    clear_stickers(document.getElementById('video_id'));
    document.querySelector('.error').innerHTML = '';
  }
  else {
    document.querySelector('.error').innerHTML = 'pleas chose sticker';
  }
}

function    copy_stickers(){
  let elem = document.getElementById('video_id');
  var canva = document.getElementById('canva_id');
  // console.log('copy');
  
  elem.querySelectorAll('#copy').forEach((e)=>{
    // console.log(e);
    if (e.id === 'copy')
      canva.appendChild(e);
    // if (e.id === 'copy'){
    //   console.log(e);
      
    // }
  });
}


function   dragstart(ev){
  // event.preventDefault();
  // console.log('drop');
  ev.dataTransfer.setData('text/plain', ev.target.id)
  // console.log(ev);
  
  // ev.dataTransfer.setDragImage(ev.target.id, 10, 10);
}


function    ondraging(event){
  // console.log('ondrag');
  // console.log(event.screenX + ' ' + event.screenY);
  
  
}

function    _onDragover(event){
  // console.log(targ);
  // console.log(event.pageX + ' x=>y ' + event.pageY );
  
  // console.log(event.screenX + ' ' + event.screenY);
  // dropzone.appendChild(draggableElement);
  // console.log(event);
  
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
    let x =  event.layerX - (elem.offsetWidth / 2);
    let y =  event.layerY - (elem.offsetHeight / 2);
    // console.log(x + ' ' + y);
    // console.log(event.target);
    
    x = x < 0 ? 0 : x;
    y = y < 0 ? 0 : y;
    x = (x + elem.offsetWidth) > event.target.clientWidth ? (event.target.clientWidth - elem.offsetWidth) : x;
    y = (y + elem.offsetHeight) > event.target.clientHeight ? (event.target.clientHeight - elem.offsetHeight) : y;
    // x = x > event.target
    // cln.removeAttribute('id');
    cln.id = 'copy';
    cln.style.left = x + 'px';
    cln.style.top = y + 'px';
    event.path[1].appendChild(cln);
    if (event.target.id === 'video')
      sticker_ivdeo = 1;
    else if (event.target.id === 'canva')
      sticker_canva = 1;
  }
  // console.log(elem.src);
  
  
  
}

function    new_event(targ){
  targ.addEventListener('dragover', _onDragover, false);
  targ.addEventListener('drop', _onDrop, false)
}

function    delete_event(targ){
  targ.removeEventListener('dragover', _onDragover);
  targ.removeEventListener('drop', _onDrop);
  // console.log('test');
  
}

function    clear_stickers(elem){
  // console.log(elem.id);
  let children = elem.querySelectorAll('#copy');
  // console.log(children);
  
  children.forEach((e)=>{
    // console.log(e);
    e.remove();
    
  });
  

}

document.querySelector('.stickers').childNodes.forEach((e)=>{
  // console.log(e);
  e.addEventListener('drag', ondraging);
  e.addEventListener('dragstart', dragstart);
  // e.addEventListener('draggable', ev => {}, true);
  
});

