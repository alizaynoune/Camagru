
/////////////////////////globale varialbes///////////////////////////////////
////////////////////////////////////////////////////////////////////////////
var   captur = 0;
var   sticker_video = 0;
var   sticker_canva = 0;
var   listener;
var   new_id = 0;
var   e_listener;


function  show_erea(){
  const select = document.querySelectorAll('.display');
  var video = document.getElementById('video');
  var canva = document.getElementById('canva');
  delete_event(canva);
  new_event(video);
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
  var contener_video = document.getElementById('contener_video');
  // console.log(contener_video.style.display);
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
  // console.log(document.querySelector('input[name="camera"]').checked);
  
    if (document.querySelector('input[name="camera"]').checked === true){
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
    try{
      navigator.mediaDevices.getUserMedia(constraints)
      .then((stream) => {
        video.srcObject = stream;
      })
      .catch(err => {
        document.querySelector('.error').innerHTML = err;
        document.querySelector('input[name=camera]').checked = false;
        hidden_erea();
      });document.querySelector('.error').innerHTML = '';
    }catch(err2){
      document.querySelector('.error').innerHTML = "NotAllowedError: Permission denied";
      document.querySelector('input[name=camera]').checked = false;
      hidden_erea();
      
    }
      
  }
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

function    upload_to_canva(event){
  camera_off();
    if (event.target.files[0].size < 2000000){
    document.querySelector('input[name=camera]').checked = false;
    var canva = document.getElementById('canva');
    var canva_id = document.getElementById('canva_id');
    var size = document.getElementById('hiddenCanva');
    // console.log(size.width);
    var ctx = canva.getContext('2d');
    ctx.clearRect(0, 0, canva.width, canva.height);
    var img = new Image();
    img.onload = function(){
      canva.width = size.width * 1.5;
      canva.height = canva.width;
      clear_stickers(document.getElementById('canva_id'));
      var factor = Math.min((canva.width / img.width), (canva.height / img.height));
      canva.height = img.height * factor;
      canva.width = img.width * factor;

      ctx.drawImage(img, 0, 0, canva.width, canva.height);
        canva_id.style.height = (canva.height) + 'px';
        canva_id.style.width = (canva.width) + 'px';
    };
    if (event.target.files[0]){
      img.src = URL.createObjectURL(event.target.files[0]);
      captur = 0;
      new_event(document.getElementById('canva'));
    }
  }
  else{
    document.querySelector('.error').innerHTML = 'Image is so large';
  }
  
}

function    capture_img(){
  let box = document.querySelector('input[name=stickers]').checked;
  if (sticker_video > 0 || box === false){
    var contener_canva = document.getElementById('canva_id');
    captur = 1;    
    sticker_video = 0;
    var canva = document.getElementById('canva');
    var video = document.getElementById('video');
    canva.width = video.videoWidth;
    canva.height = video.videoHeight;
    contener_canva.style.height = (canva.height) + 'px';
    contener_canva.style.width = (canva.width) + 'px';
    clear_stickers(contener_canva);
    canva.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
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
  elem.querySelectorAll('div').forEach((e)=>{
    if (e.id.search('copy') !== -1){
      e.removeEventListener('dragover', _onDragover, false);
      e.removeEventListener('drop', _onDrop, false);
      e.children[0].removeEventListener('dragstart', dragstart);
      e.querySelectorAll('div').forEach((div)=>{
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
  let id = ev.target.id;
    ev.dataTransfer.setData('text/plain', id);
}

//////////////////////////try to delete it........................
function    ondraging(event){
}

function    _onDragover(event){
  event.preventDefault();
}

function    _onDrop(event){
  const id = event.dataTransfer.getData('text');
  const elem = document.getElementById(id);
  if (elem !== null){
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
    let x =  (event.pageX - window.scrollX) - rect.x - (elem.offsetWidth / 2);
    let y =  (event.pageY - window.scrollY) - rect.y - (elem.offsetHeight / 2);
    x = x < 0 ? 0 : x;
    y = y < 0 ? 0 : y;
    x = (x + elem.offsetWidth) > rect.width ? rect.width - elem.offsetWidth : x;
    y = (y + elem.offsetHeight) > rect.height ? rect.height - elem.offsetHeight : y;    
    cln.style.left = x + 'px';
    cln.style.top = y+ 'px';
    listener.parentNode.appendChild(cln);
    if (event.srcElement.id === 'video')
      sticker_video++;
    else if (event.srcElement.id === 'canva')
      sticker_canva++;
  }
}

function    new_elem(stic){
  stic.removeEventListener('click', sticker_click);
  var   name_class = ['resize' ,'delet'];
  var   parent = document.createElement('div');
  parent.classList.add('filter');
  // stic.style.transform = 'rotate(0deg)';
  parent.style.width ='40px';
  parent.style.height = '40px';
  parent.appendChild(stic);
  name_class.forEach((e)=>{
    let div = document.createElement('div');
    div.classList.add(e);
    if (e === 'resize'){
      div.setAttribute('draggable', true);
      div.addEventListener('dragstart', initResize, false);
    }
    else if (e === 'delet'){
      div.addEventListener('click', function(event){
        if (listener.id === 'video')
          sticker_video--;
        else if (listener.id === 'canva')
          sticker_canva--;
        event.target.parentNode.remove();
      });
    }

    parent.appendChild(div);
  });
  parent.addEventListener('dragover', _onDragover, false);
  parent.addEventListener('drop', _onDrop, false);
  stic.addEventListener('dragstart', dragstart, false);

  return(parent);
}

function    sticker_click(event){
  if (listener){
    let cln = event.target.cloneNode(true);
    let rect = listener.getBoundingClientRect();
    let left = (new_id % (rect.width / 40)) * 40;
    left = left + 40 >= rect.width ? 0 : left;
    let top = ((Math.trunc((new_id + 1) / (rect.width / 40))) % (rect.height / 40)) * 40 ;
    top = top + 40 >= rect.height ? 0 : top;
    cln.id = `${new_id}`;
    cln = new_elem(cln);
    cln.id =  `copy${new_id++}`;
    cln.style.left = left + 'px';
    cln.style.top = top + 'px';
    listener.parentNode.appendChild(cln);
    if (listener.id === 'canva')
      sticker_canva++;
    else if (listener.id === 'video')
      sticker_video++;
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
  
}



////////////////document ready///////////////////////

document.querySelector('.stickers').childNodes.forEach((e)=>{
  e.addEventListener('dragstart', dragstart, false);
  e.addEventListener('click', sticker_click, false);
});

document.querySelector('input[name=camera]').addEventListener('change', (e)=>{
  if (e.target.checked === true)
  camera_on();
else
  camera_off();
});

// document.querySelector('input[name=stickers]').addEventListener('change', (e)=>{
//   if (e.target.checked === false)
//     document.querySelector('.stickers').classList.add('hidden-stickers');
//   else
//     document.querySelector('.stickers').classList.remove('hidden-stickers');
// });



/////////////////////////////resize stickers///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

function        initResize(event){
  var target = event.target.parentElement;
  var targ_info = target.getBoundingClientRect();
  var listener_info = listener.getBoundingClientRect();
  event.target.addEventListener('drag', Resize, false);
  event.target.addEventListener('dragend', stopResize, false);
  

  function      stopResize(e){
    event.target.removeEventListener('drag', Resize, false);
    event.target.removeEventListener('dragend', stopResize, false);
  }
  
  function      Resize(e){
    if ((e.clientY + 5 >= (listener_info.y + listener_info.height)) || (e.clientX + 5 >= (listener_info.x + listener_info.width)) ){
      stopResize(e);
    }
    let x = targ_info.width + (e.clientX - event.clientX);
    let y = targ_info.height + (e.clientY - event.clientY);

    x = x < 20 ? 20 : x;
    y = y < 20 ? 20 : y;
    target.style.width = x + 'px';
    target.style.height = y + 'px'
  }
  
}









