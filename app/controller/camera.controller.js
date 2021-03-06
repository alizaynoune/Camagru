
function        valid_titel(elem){
    let REG = /^[\w-_\--\d]+$/;
    if (titel.value.length === 0){
        titel.classList.remove('error');
        return true;
    }
    if (!REG.test(titel.value)){
        titel.classList.add('error');
        return false;
    }
    else{
        titel.classList.remove('error');
        return true;
    }
}

const form = document.querySelector('form');
var titel = form.querySelector("input[name='titel']");
titel.addEventListener('input', (e)=>{
    valid_titel(titel);
        
})
form.addEventListener('submit', (e) =>{
    var _Error_ = document.querySelector('.error');
    var _Success_ = document.querySelector('.success');
    _Error_.innerHTML = '';
    _Success_.innerHTML = '';
    
    e.preventDefault();
    if (valid_titel(titel) === false){
        e.preventDefault();
        return false;
    }
    
    const canvas = document.getElementById('canva_id');
    const canva = document.getElementById('canva');
    var img = canva.toDataURL('image/png');
    if (img === document.getElementById('hiddenCanva').toDataURL()){
        _Error_.innerHTML = 'blanck canva';
        e.preventDefault();
        return false;
    }
    var stickers = [];
    var left = [];
    var top = [];
    // var retate = [];
    var width = [];
    var height = [];
    form.querySelector("input[name='canva']").value = img;
    canvas.querySelectorAll('.filter').forEach((e)=>{
        left.push(e.style.left.match(/[\d\.]+/g).join(''));
        top.push(e.style.top.match(/[\d\.]+/g).join(''));
        width.push(e.style.width.match(/[\d\.]+/g).join(''));
        height.push(e.style.height.match(/[\d\.]+/g).join(''));
        let name = e.querySelector('img').src.split('/');
        stickers.push(name[name.length - 1]);
        
    });
    form.querySelector("input[name='stickers']").value = stickers;
    form.querySelector("input[name='left']").value = left;
    form.querySelector("input[name='top']").value = top;
    form.querySelector("input[name='width']").value = width;
    form.querySelector("input[name='height']").value = height;
    // document.querySelector('input[name=camera]').checked = false;
    
    
    

    ///////////////////////////////ajax send data to server///////////////////////
    var url = '../../model/NewPost.model.php';
    var request = new XMLHttpRequest();
    request.open('Post', url, true);
    request.onload = function(){
        var ret =JSON.parse(this.responseText);
        // console.log(ret[0]);
        if (typeof ret[0] !== 'undefined'){
            console.log(ret[0]);
            new_post(ret);
            
        }

        
        
        // for (var i = 0; i < ret.length; i++){
        //     console.log(ret[i]);
            
        // }
        _Success_.innerHTML = 'Success Share';
    };

    request.onerror = function(){
        _Error_.innerHTML = 'Error Share';
    };
    request.send(new FormData(e.target));
    
    e.preventDefault();
    return true;
});


///////////////////////////////////append new post/////////////////////////////

function        new_post(elem){
    var thumb = document.querySelector('.thumbnails');
    var new_div = document.createElement('div');
    new_div.classList.add('post');
    var img = document.createElement('img');
    img.src = elem[0];
    new_div.appendChild(img);
    // thumb.appendChild(new_div);
    thumb.insertBefore(new_div, thumb.firstChild);
}

