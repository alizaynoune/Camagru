
function        valid_title(elem){
    let REG = /^[\w\d\-_]+$/;
    if (title.value.length === 0){
        title.classList.remove('error');
        return true;
    }
    if (!REG.test(title.value) || title.value.length > 50){
        title.classList.add('error');
        return false;
    }
    else{
        title.classList.remove('error');
        return true;
    }
}

const form = document.querySelector('form');
var title = form.querySelector("input[name='title']");
title.addEventListener('input', (e)=>{
    valid_title(title);
        
})
form.addEventListener('submit', (e) =>{
    var _Error_ = document.querySelector('.error');
    var _Success_ = document.querySelector('.success');
    _Error_.innerHTML = '';
    _Success_.innerHTML = '';
    
    e.preventDefault();
    if (valid_title(title) === false){
        e.preventDefault();
        _Error_.innerHTML = 'title invalid';
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
    
    
    

    ///////////////////////////////ajax send data to server///////////////////////
    var url = '../../model/NewPost.model.php';
    var request = new XMLHttpRequest();
    request.open('Post', url, true);
    request.onload = function(){
        try{
            var ret =JSON.parse(this.responseText);
            new_post(ret);
            _Success_.innerHTML = 'Success Share';
            form.querySelector("input[name='stickers']").value = '';
            form.querySelector("input[name='left']").value = '';
            form.querySelector("input[name='top']").value = '';
            form.querySelector("input[name='width']").value = '';
            form.querySelector("input[name='height']").value = '';
            form.querySelector("input[name='title']").value = '';
        }catch(e){
            _Error_.innerHTML = e;
        }
    };
    request.onerror = function(){
        _Error_.innerHTML = 'Errors Share';
    };
    request.send(new FormData(e.target));
    
    e.preventDefault();
    return true;
});


///////////////////////////////////append new post/////////////////////////////

function        new_post(elem){
    // selet thumb 
    let thumb = document.querySelector('.thumbnails');

    //create post
    let new_post = document.createElement('div').classList.add('post');
    // creat button delet post
    let delet_post = document.createElement('span').classList.add('delet_post');
    // create input (stor info post)
    let post_info = document.createElement('input').type = 'hidden';
    post_info.name = 'post_info';
    //create div info will has (img_owner, name_owner, title)
    let info = document.createElement('div').classList.add('info');
    // create create img (img_owner)
    


    
//     let new_div = document.createElement('div');
//     new_div.classList.add('post');
    
//     let img = document.createElement('img');
//     img.src = elem[0];
    
//     let title = document.createElement('h3');
//     title.innerHTML = elem[1];
    
//     new_div.appendChild(title);
//     new_div.appendChild(img);

//     let div_like_comment = document.createElement('div');
//     div_like_comment.classList.add('like_comment');
   
    
//     let comment = document.createElement('p');
//     comment.classList.add('comment');
//     div_like_comment.appendChild(comment);
//     // comment.innerHTML = 'new comment';

//     let nbr_like = document.createElement('h4');
//     nbr_like.classList.add('likeNbr');
//     div_like_comment.appendChild(nbr_like);

//     let nbr_comment = document.createElement('h4');
//     nbr_comment.classList.add('commentNbr');
//     div_like_comment.appendChild(nbr_comment);

    
//     let like = document.createElement('span');
//     like.classList.add('dislike');
//     div_like_comment.appendChild(like);
    
//  new_div.appendChild(div_like_comment);
// thumb.insertBefore(new_div, thumb.firstChild);
}

