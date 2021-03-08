
function        valid_title(elem){
    let REG = /^[\w\d\-_\ ]+$/;
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
    let new_post = document.createElement('div');
        new_post.classList.add('post');
        thumb.insertBefore(new_post, thumb.firstChild);
    // creat button delet post
    let delet_post = document.createElement('span');
        delet_post.classList.add('delet_post');
        new_post.appendChild(delet_post);
    
    // create input (stor info post)///
    //////////////////////////////////
    let post_info = document.createElement('input');
        post_info.type = 'hidden';
        post_info.name = 'post_info';
        new_post.appendChild(post_info);
    //create div info will has (img_owner, name_owner, title)
    let info = document.createElement('div');
        info.classList.add('info');
        new_post.appendChild(info);
    // create create img (img_owner)
    let img_owner = document.createElement('img');
        img_owner.setAttribute('id', 'img_owner');
        img_owner.src = document.querySelector('.img').src;
        info.appendChild(img_owner);
    // create h4 hase name of owner
    let name_owner = document.createElement('h4');
        name_owner.classList.add('owner');
        name_owner.innerHTML = 'name of owner';
        info.appendChild(name_owner);
    // create h2 will has title of post
    let title = document.createElement('h2');
        title.classList.add('title');
        title.innerHTML = elem[1];
        info.appendChild(title);

    // create img will hase image of post
    let img_post = document.createElement('img');
        img_post.setAttribute('id', 'img_post');
        img_post.src = elem[0];
        new_post.appendChild(img_post);
    
    // create contener will has (post like, comment)//
    //////////////////////////////////////////////////
    let comment_like = document.createElement('div');
        comment_like.classList.add('comment_like');
        new_post.appendChild(comment_like);

    //create contener like//
    ///////////////////////
    let contener_like = document.createElement('div');
        contener_like.classList.add('contener_like');
        comment_like.appendChild(contener_like);
    
    /// create lable has like or dislike icon [defulte dislike]
    let like = document.createElement('label');
        like.classList.add('dislike');
        like.addEventListener('click', toggle_like, false);
        contener_like.appendChild(like);
    ////create span has total number of like [defulte 0]
    let nb_like = document.createElement('span');
        nb_like.innerHTML = '0';
        contener_like.appendChild(nb_like);
    /// create lable hase total number of comment [defulte 0]
    let nb_comment = document.createElement('lable');
        nb_comment.classList.add('commentNbr');
        nb_comment.innerHTML = '0 comments';
        contener_like.appendChild(nb_comment);
        nb_comment.addEventListener('click', toggle_comments, true);
    
        // create contener of comments
    let contener_comment = document.createElement('div');
        contener_comment.classList.add('contener_comment');
        comment_like.appendChild(contener_comment);
    // create contener will has all old comments def [null, hidden]
    let comment = document.createElement('div');
        comment.classList.add('comment');
        comment.classList.add('hidden');
        contener_comment.appendChild(comment);

    // create contener of new comment
    let new_comment = document.createElement('div');
        new_comment.classList.add('new_comment');
        contener_comment.appendChild(new_comment);

    // create input of new comment
    let input_comment = document.createElement('input');
        input_comment.type = 'text';
        input_comment.name = 'comment';
        input_comment.placeholder = 'add comment';
        new_comment.appendChild(input_comment);

    // create contener of submit
    let contener_submit = document.createElement('div');
        new_comment.appendChild(contener_submit);

    //create input of submit
    let input_submit = document.createElement('input');
        input_submit.setAttribute('id', 'submit_comment');
        input_submit.type = 'submit';
        input_submit.name = 'submit';
        input_submit.value = 'comment';
        contener_submit.appendChild(input_submit);
    
    // create lable of submit 
    let lable_submit = document.createElement('label');
        lable_submit.setAttribute('id', 'submit');
        lable_submit.setAttribute('for', 'submit_comment');
        contener_submit.appendChild(lable_submit);
}

