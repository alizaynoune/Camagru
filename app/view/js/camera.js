
///////////////////////////////////////////////////////////////
/////////////////////////globale varialbes/////////////////////
///////////////////////////////////////////////////////////////
var   captur = 0;
var   sticker_video = 0;
var   sticker_canva = 0;
var   listener;
var   new_id = 0;
var   e_listener;

var   resolution = [[640,360], [176, 144]];
// [[320, 480],[480, 640], [240, 320]];
// console.log(resolution[get_res.value]);

function      change_resolution(){
  camera_off();
  camera_on();

}

/////////////////////////////////////////////
////////// show erea video //////////////////
/////////////////////////////////////////////
function  show_erea(){
  const select = document.querySelectorAll('.display');
  var video = document.getElementById('video');
  var canva = document.getElementById('canva');
  delete_event(canva);
  new_event(video);
  select.forEach(function(elem){
    elem.classList.remove('hiddenBtn');
  });
  // var contener_video = document.getElementById('contener_video');
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


//////////////////////////////////////
//////// stream video ////////////////
//////////////////////////////////////
function     streamVideo(){  
  navigator.getUserMedia = navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.mediaDevices;
  if (navigator.getUserMedia){
    var size = document.getElementById('canva_id');
    // console.log(size);
    const video = document.getElementById('video');
    console.log(size.offsetWidth);
    
    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
          width : 640,
          height : 480,
          // width: { min: 160, ideal: 640, max: 704 },
          // height: { min: 120, ideal: 360, max: 480 },
          // width: {min:size.offsetWidth, ideal:size.offsetWidth, max:size.offsetWidth},
          // height: {min:size.offsetHeight, ideal:size.offsetHeight, max:size.offsetHeight},
        }
        
      }
      ).then(function(stream){
        // video.srcElement = video;
        console.log(video.videoWidth + ' ' + video.videoHeight);
        video.srcObject = stream;
        video.play();
        console.log(video);
        // new_event(video);
        
        
        // size.offsetHeight = video.videoHeight;
        // size.offsetWidth = video.videoWidth;
        document.querySelector('.error').innerHTML = "";
      }).catch(function(er){
        document.querySelector('.error').innerHTML = er;
        // "NotAllowedError: Permission denied";
        document.querySelector('input[name=camera]').checked = false;
        hidden_erea();
      });
    }
    else{
      document.querySelector('.error').innerHTML = 'Camera Not fond';
      document.querySelector('input[name=camera]').checked = false;
      hidden_erea();
    }
  }

////////////////////////////////////
/////// turn on camera  ////////////
////////////////////////////////////
function  camera_on(){  
    if (document.querySelector('input[name="camera"]').checked === true){
    show_erea();
    streamVideo();
  }
}

///////////////////////////////////////////////
/////////// turn off camera ///////////////////
///////////////////////////////////////////////
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

//////////////////////////////////////////////////////////////////
///////// upload photo from your locale files to canvas //////////
//////////////////////////////////////////////////////////////////
function    upload_to_canva(event){
  camera_off();
    if (event.target.files[0].size < 2000000){
    document.querySelector('input[name=camera]').checked = false;
    var canva = document.getElementById('canva');
    var canva_id = document.getElementById('canva_id');
    var size = document.getElementById('hiddenCanva');
    console.log(size.width + ' ' + size.height);
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

/////////////////////////////////////////////////////////////////////////
////////// capture photo from stream video and draw it at canvas ////////
/////////////////////////////////////////////////////////////////////////
function    capture_img(){
  var box = document.querySelector('input[name=stickers]').checked;
  if (sticker_video > 0 || box === false){
    var contener_canva = document.getElementById('canva_id');
    captur = 1;    
    sticker_video = 0;
    var canva = document.getElementById('canva');
    var video = document.getElementById('video');
    var factor = Math.min((canva.width / video.videoWidth), (canva.height / video.videoHeight));
    canva.width = video.videoWidth;
    canva.height = video.videoHeight;
    console.log(video.videoWidth);
    
    contener_canva.offsetHeight = (canva.offsetHeight);
    contener_canva.offsetWidth = (canva.offsetWidth);
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


////////////////////////////////////////////////////////////////////
/////////// copy stickers from stream video to canvas //////////////
////////////////////////////////////////////////////////////////////
function    copy_stickers(){
  var elem = document.getElementById('video_id');
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

/////////////////////////////////////////////////////////////////////
///////////// clear stickers from video stream or canvas ////////////
/////////////////////////////////////////////////////////////////////
function    clear_stickers(elem){
  
  elem.querySelectorAll('div').forEach((e)=>{
    if (e.id.search('copy') !== -1)
      e.remove();
  });

}


/////////////////////////////////////////////////////////////////
///////// set Data where start drag sticker /////////////////////
/////////////////////////////////////////////////////////////////
function   dragstart(ev){
  // console.log(ev);
  
  var id = ev.target.id;
    ev.dataTransfer.setData('text/plain', id);
}

/////////////////////////////////////////////////////////////////
///////////// set prevent Defaut where on draging sticker ///////
/////////////////////////////////////////////////////////////////
function    ondraging(event){
  event.preventDefault();
}


////////////////////////////////////////////////////////////////////////////////////
///////////// set prevent Default where sticker is over Canvas or video stream /////
////////////////////////////////////////////////////////////////////////////////////
function    _onDragover(event){
  // console.log(event);
  event.preventDefault();
}

////////////////////////////////////////////////////////////////////////////
////////// event where stiker is drop at canvas or video stream ////////////
////////////////////////////////////////////////////////////////////////////
function    _onDrop(event){
  
  event.preventDefault();
  const id = event.dataTransfer.getData('text');
  const elem = id !== '' ? document.getElementById(id) : null;
  var perW;
  var perH;
  var rect = listener.getBoundingClientRect();
  if (elem !== null){
    if (id.search('img') !== -1) {
      var cln = elem.cloneNode(true);
      cln.id = `${new_id}`;
      cln = new_elem(cln);
      // perW = ;
      // perH = ;
      cln.style.width = ((elem.offsetWidth / rect.width) * 100) + '%';
      cln.style.height = ((elem.offsetHeight / rect.height) * 100) + '%';
      cln.id =  `copy${new_id++}`;
    }
    else{
      var cln = elem.parentElement;
      // perW = cln.style.width;
      // perH = cln.style.height
    }
    // console.log(cln.style.width.replace('%',''));
    
    var elemW = (((cln.style.width.replace('%','')) * rect.width)/100);
    var elemH = (((cln.style.height.replace('%','')) * rect.height)/100);
    
    var x =  (event.pageX - window.scrollX) - rect.x - (elemW / 2);
    var y =  (event.pageY - window.scrollY) - rect.y - (elemH / 2);
    x = x < 0 ? 0 : x;
    y = y < 0 ? 0 : y;
   
    x = (x + elemW) > rect.width ? rect.width - elemW : x;
    y = (y + elemH) > rect.height ? rect.height - elemH : y;    
    cln.style.left = ((x / rect.width) * 100) + '%';
    cln.style.top = ((y / rect.height) * 100) + '%';
    // console.log(cln.style.top + ' ' + y + ' ' + rect.height);
    // 213  480
    listener.parentNode.appendChild(cln);
    if (event.srcElement.id === 'video')
      sticker_video++;
    else if (event.srcElement.id === 'canva')
      sticker_canva++;
  }
  
}

///////////////////////////////////////////////////////////////////////////
////////// copy sticker in div and apend it in Canvas or video ////////////
///////////////////////////////////////////////////////////////////////////
function    new_elem(stic){
  var listener_info = listener.getBoundingClientRect();
  // var stic_info = stic.getBoundingClientRect();
  console.log(listener_info.width + '=>' + stic.width);
  console.log(stic);
  
  // console.log(stic_info);
  
  
  stic.removeEventListener('click', sticker_click);
  var   name_class = ['resize' ,'delet'];
  var   parent = document.createElement('div');
  parent.classList.add('filter');
  parent.appendChild(stic);
  name_class.forEach((e)=>{
    var div = document.createElement('div');
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

///////////////////////////////////////////////////////////////////////////////////////////////
//////// event where click sticker [in div sticker] to copy it in Canvas or video stream //////
///////////////////////////////////////////////////////////////////////////////////////////////
function    sticker_click(event){
  if (listener){
    // console.log('========================');
    
    // console.log(event.target.getBoundingClientRect());
    var targ_info = event.target.getBoundingClientRect();
    var rect = listener.getBoundingClientRect();
    var cln = event.target.cloneNode(true);
    var left = (new_id % (rect.width / 40)) * 40;
    left = left + 40 >= rect.width ? 0 : left;
    var top = ((Math.trunc((new_id + 1) / (rect.width / 40))) % (rect.height / 40)) * 40 ;
    top = top + 40 >= rect.height ? 0 : top;
    cln.id = `${new_id}`;
    cln = new_elem(cln);
    cln.style.width = ((targ_info.width / rect.width) * 100) + '%';
    cln.style.height = ((targ_info.height / rect.height) * 100) + '%';
    cln.id =  `copy${new_id++}`;
    cln.style.left = ((left / rect.width) * 100) + '%';
    cln.style.top = ((top / rect.height) * 100) + '%';
    listener.parentNode.appendChild(cln);
    if (listener.id === 'canva')
      sticker_canva++;
    else if (listener.id === 'video')
      sticker_video++;
  }
}

/////////////////////////////////////////////////////////////////////////////////////////
////////// add event dragover and drop at (Canvas or video Stream) //////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function    new_event(targ){
  targ.addEventListener('dragover', _onDragover, false);
  targ.addEventListener('drop', _onDrop, false);
  listener = targ;
}

////////////////////////////////////////////////////////////////////////////////////////
//////// delet event dragover and drop from (Canvas or video Stream)////////////////////
////////////////////////////////////////////////////////////////////////////////////////
function    delete_event(targ){
  targ.removeEventListener('dragover', _onDragover);
  targ.removeEventListener('drop', _onDrop);
  
}



///////////////////////////////////////////////////////////////////
////// add event dragstart and click at all stickers //////////////
///////////////////////////////////////////////////////////////////
document.querySelector('.stickers').childNodes.forEach((e)=>{
  e.addEventListener('dragstart', dragstart, false);
  e.addEventListener('click', sticker_click, false);
  // e.addEventListener('draging', ondraging, false);
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


///////////////////////////////////////////////////////////////////////////////
//////////////////// init resize stickers   ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
function        initResize(event){
  event.dataTransfer.setData('text/plain',null);
  var target = event.target.parentElement;
  var targ_info = target.getBoundingClientRect();
  var listener_info = listener.getBoundingClientRect();
  var oldX = event.clientX;
  var oldY = event.clientY;
  // console.log(listener.parentElement.querySelectorAll('.filter'));
  listener.parentElement.querySelectorAll('.filter').forEach((rect)=>{
    rect.addEventListener('dragover', Resize, false);
    // console.log(rect);
    
  });
  listener.addEventListener('dragover', Resize, false);
  // target.addEventListener('dragover', Resize, false);

  // listener.querySelectorAll('')
  // event.target.addEventListener('drag', Resize, true);
  event.target.addEventListener('dragend', stopResize, false);
  

  /////////////////////////////////////////////////////
  ///////// stop resize Sticker ///////////////////////
  /////////////////////////////////////////////////////
  function      stopResize(e){
    // console.log(e);
    listener.removeEventListener('dragover', Resize, false);
    // listener.addEventListener('dragover', Resize, false);
    // target.addEventListener('dragover', Resize, false);
    listener.parentElement.querySelectorAll('.filter').forEach((rect)=>{
      rect.removeEventListener('dragover', Resize, false);
    });
    // target.removeEventListener('dragover', Resize, false);
    event.target.removeEventListener('dragend', stopResize, false);
    e.preventDefault();
  }
  
  /////////////////////////////////////////////////////////////
  //////// sticker resize event (modef with and height) ///////
  /////////////////////////////////////////////////////////////
  function      Resize(e){
    // listener.addEventListener('dragover', Resize, true);
    // console.log(e);
    // console.log(listener);
    
    var x = targ_info.width + (e.clientX - oldX);
    var y = targ_info.height + (e.clientY - oldY);    
    x = x < 20 ? 20 : x;
    y = y < 20 ? 20 : y;
    // console.log(e.width);
    // console.log(target.getBoundingClientRect());
    // console.log('==============================');
    // perW = ((elem.offsetWidth / rect.width) * 100);
    
    if (x < e.target.offsetWidth)
      target.style.width = ((x / listener_info.width) * 100) + '%';
    if (y < e.target.offsetHeight)
      target.style.height = ((y / listener_info.height) * 100) + '%';
    // e.preventDefault();
  }
}

var     lastdate = '0'; ////////// date of last post get from DB ////////////
var     contener = document.querySelector('.thumbnails');
// var     login = document.querySelector('.login');

///////////////////////////////////////////////////////////////////
///////// where page is loaded get last 5 post of this user ///////
///////////////////////////////////////////////////////////////////
window.addEventListener('load', function(){
  request_profile(login, lastdate, contener);
  ////////////////////////////////////////////////////////////////
  ///// where scroll down at bottum fetch again last 5 post //////
  ////////////////////////////////////////////////////////////////
  window.addEventListener('scroll', function(e){
    if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
      request_profile(login, lastdate, contener);
      }
    });

});









