
window.addEventListener('load', function () {
    defult_avatar();
  })

function        defult_avatar(){
    var def = document.querySelector('.img');
    var trgt = document.querySelector('#src_avatar');
    var trgt2 = document.querySelector('.change_avatar');
    document.querySelector('.msj_new_av').innerHTML = "";
    trgt.src = def.src;
    trgt2.src = def.src;
}

function        hidden_modal(){
    var elem = document.querySelector('.modal');
    elem.classList.remove('modal-show');
    document.querySelector('input[name="img_user"]').value = '';
    document.querySelector('input[name="img_db"]').value = '';
    defult_avatar();   
}

function        show_modal(){
    var elem = document.querySelector('.modal');
    elem.classList.add('modal-show');
}

function        load_img(event){
    if (event.target.files[0].size < 2000000){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('src_avatar');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        document.querySelector('.camera').value = '';
    }
    else{
        document.querySelector('.msj_new_av').innerHTML = 'Image is so large';
    }
}

function        valid_img(){
    var elem = document.querySelector('.modal');
    elem.classList.remove('modal-show');
    var n_avatar = document.querySelector('#src_avatar');
    var trgt = document.querySelector('.change_avatar');
    trgt.src = n_avatar.src;
    if (trgt.src !== document.querySelector('.img').src)
        document.querySelector('.msj_new_av').innerHTML = "your new avatar is ready click Submit to update it";
}


//////////////////////////////////////////////////////////////////
///////// select new avatar from your profile ////////////////////
//////////////////////////////////////////////////////////////////
var     lastdate = '0';
function        img_from_profile(){
    let contener = document.createElement('div');
        contener.classList.add('contener_select_profile');
        document.body.insertBefore(contener, document.body.firstChild);    
    let area_imgs = document.createElement('div');
        area_imgs.classList.add('area_imgs');
        area_imgs.addEventListener('scroll', function(){
            if ((Math.ceil(area_imgs.scrollTop)) >= (Math.ceil(area_imgs.scrollHeight - area_imgs.clientHeight))){
                request_profile_id(lastdate, area_imgs);
            }
        }, true);
        contener.appendChild(area_imgs);
    let cancel = document.createElement('button');
        cancel.setAttribute('id', 'cancel_select');
        cancel.classList.add('BtnAnim');
        contener.appendChild(cancel);
        cancel.addEventListener('click', function(){
            contener.remove();
            lastdate = '0';
        },true);
    let label_cancel = document.createElement('label');
        label_cancel.setAttribute('for', 'cancel_select');
        label_cancel.classList.add('Btn');
        label_cancel.classList.add('cancel');
        label_cancel.innerHTML = 'cancel';
        contener.appendChild(label_cancel);
        request_profile_id(lastdate, area_imgs);
}

//////////////////////////////////////////////////////////////////
////////// copy select avatar to init area avatar ////////////////
//////////////////////////////////////////////////////////////////
function        select_avatar(e){
    console.log(e.target);
    document.querySelector('#src_avatar').src = e.target.src;
    document.getElementById('cancel_select').click();
    let post = e.target.closest('.post');
    document.querySelector('input[name="img_db"]').value = post.querySelector('input[name="info"]').value;
    console.log(document.querySelector('input[name="img_db"]').value);
}