
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

function        hedin_modal(){
    var elem = document.querySelector('.modal');
    elem.classList.remove('modal-show');
    document.querySelector('.camera').value = '';
    document.querySelector('.upload').value = '';
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