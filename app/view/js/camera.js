
// window.addEventListener('load', function () {
//   add_event();
// })
var   captur = 0;
var   sticker_ivdeo = 0;
var   sticker_canva = 0;
var   listener;
var   new_id = 0;
var   e_listener;


function  show_erea(){
  const select = document.querySelectorAll('.display');
  //   remove_event(document.querySelector('.event'));
  delete_event(document.getElementById('canva'));
  new_event(document.getElementById('video'));
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
}

function  hidden_erea(){
  const select = document.querySelectorAll('.display');
  if (captur === 0)
    new_event(document.getElementById('canva'));
  clear_stickers(document.getElementById('video_id'));
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
    })
    .catch(err => {
      document.querySelector('.error').innerHTML = err;
      // document.getElementById('checkbox').checked = false;
      document.querySelector('input[name=camera]').checked = false;
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

// function  control_camera(elem){
//   if (elem.target.checked === true)
//     camera_on();
//   else
//     camera_off();
// }


function    upload_to_canva(event){
  camera_off();
  // document.getElementById('checkbox-camera').checked = false;
  document.querySelector('input[name=camera]').checked = false;
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
  // let box = document.getElementById('checkbox-stickers').checked;
  // console.log(box);
  let box = document.querySelector('input[name=stickers]').checked;
  
  if (sticker_ivdeo === 1 || box === false){
    captur = 1;
    sticker_ivdeo = 0;
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
  
  elem.querySelectorAll('div').forEach((e)=>{
    // console.log(e.id);
    if (e.id.search('copy') !== -1){
      // console.log(e);
      e.querySelectorAll('div').forEach((div)=>{
        // console.log(div);
        div.style.display = 'none';
      });
      canva.appendChild(e);
    }
  });
}

function    clear_stickers(elem){
  
  elem.querySelectorAll('div').forEach((e)=>{
    if (e.id.search('copy') !== -1)
      e.remove();
  });

}


function   dragstart(ev){
  // event.preventDefault();
  // console.log('drop');
  console.log('dragstart');
    console.log(ev);
  let id = ev.target.id;
  // if (id !== 'copy')
    ev.dataTransfer.setData('text/plain', id);
    
    
    
}


function    ondraging(event){
  // console.log('ondrag');
  // console.log(event.screenX + ' ' + event.screenY);
  
  
}

function    _onDragover(event){
  event.preventDefault();
}

function    _onDrop(event){
  const id = event.dataTransfer.getData('text');
  const elem = document.getElementById(id);
  if (elem !== null){
    // console.log(id);
    if (id.search('img') !== -1) {
      var cln = elem.cloneNode(true);
      cln.id = `${new_id}`;
      cln = new_elem(cln);
      cln.id =  `copy${new_id++}`;
    }
    else{
      var cln = elem.parentElement;

    }
    let rect = listener.getBoundingClientRect();
    let x =  event.pageX - rect.x - (elem.offsetWidth / 2);
    let y =  event.pageY - rect.y - (elem.offsetHeight / 2);
    x = x < 0 ? 0 : x;
    y = y < 0 ? 0 : y;
    x = (x + elem.offsetWidth) > rect.width ? rect.width - elem.offsetWidth : x;
    y = (y + elem.offsetHeight) > rect.height ? rect.height - elem.offsetHeight : y;    
    cln.style.left = x + 'px';
    cln.style.top = y+ 'px';
    listener.parentNode.appendChild(cln);
    if (event.srcElement.id === 'video')
      sticker_ivdeo = 1;
    else if (event.srcElement.id === 'canva')
      sticker_canva = 1;
    console.log('he');
    
  }
  
  // e_listener = event;
}

function    new_elem(stic){
  stic.removeEventListener('click', sticker_click);
  var   name_class = ['rotate', 'resize' ,'delet'];
  var   parent = document.createElement('div');
  parent.classList.add('filter');
  parent.appendChild(stic);
  name_class.forEach((e)=>{
    let div = document.createElement('div');
    div.classList.add(e);
    if (e === 'resize'){
      // div.setAttribute('draggable', true);
      // div.addEventListener('dragstart', function(event){});
    }
    else if (e === 'delet'){
      div.addEventListener('click', function(event){
        event.target.parentNode.remove();
      });
    }
    parent.appendChild(div);
  });
  parent.addEventListener('dragover', _onDragover, false);
  parent.addEventListener('drop', _onDrop, false);

  // stic.addEventListener('drag', ondraging);
  stic.addEventListener('dragstart', dragstart);

  return(parent);
}



function    sticker_click(event){
  // console.log(event.target);
  if (listener){
    let cln = event.target.cloneNode(true);
    cln.id = `${new_id}`;
    cln = new_elem(cln);
    cln.id =  `copy${new_id++}`;
    cln.style.left = '0px';
    cln.style.top = '0px';
    listener.parentNode.appendChild(cln);
    if (listener.id === 'canva')
      sticker_canva = 1;
    else if (listener.id === 'video')
      sticker_ivdeo = 1;
  }
}

function    new_event(targ){
  targ.addEventListener('dragover', _onDragover, false);
  targ.addEventListener('drop', _onDrop, false);
  listener = targ;
}

function    delete_event(targ){
  targ.removeEventListener('dragover', _onDragover);
  targ.removeEventListener('drop', _onDrop);
  // console.log('test');
  
}



////////////////document ready///////////////////////

document.querySelector('.stickers').childNodes.forEach((e)=>{
  // console.log(e);
  // e.addEventListener('drag', ondraging);
  e.addEventListener('dragstart', dragstart, false);
  e.addEventListener('click', sticker_click, false);
  // e.addEventListener('touchstart', dragstart, false);
  // e.addEventListener('draggable', ev => {}, true);
  
});

document.querySelector('input[name=camera]').addEventListener('change', (e)=>{
  // control_camera(e);
  if (e.target.checked === true)
  camera_on();
else
  camera_off();
});

document.querySelector('input[name=stickers]').addEventListener('change', (e)=>{
  // console.log(e.target.checked);
  if (e.target.checked === false)
    document.querySelector('.stickers').classList.add('hidden-stickers');
  else
    document.querySelector('.stickers').classList.remove('hidden-stickers');
});
