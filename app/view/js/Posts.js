///////////////////////////////////////
/////// get login user ////////////////
///////////////////////////////////////
var login = document.querySelector('input[name="_USER_LOGIN_"]');
login = login !== null ? login.value : login;


///////////////////////////////////////////
//////// valid input value of comments ////
///////////////////////////////////////////
function        valid_comment(elem){
    var REG = /^\S.*\S$/;
    if (elem.target.value.length === 0 || elem.target.value.length > 250){
        return false;
    }
    if (!REG.test(elem.target.value) || elem.target.value.length > 250 ){
        elem.target.classList.add('error');
        return false;
    }
    else{
        elem.target.classList.remove('error');
        return true;
    }
}


///////////////////////////////////////////////////////
////// show or hidden comments of post ///////////////
//////////////////////////////////////////////////////
function        toggle_comments(elem){
    var post = elem.target.closest('.post');
    var comment = post.querySelector('.comment');
    comment.classList.toggle('hidden');  
    
}

////////////////////////////////////////////
////////// like or dislike post ////////////
////////////////////////////////////////////
function        toggle_like_post(e){
    var post = e.target.closest('.post');
    if (login !== null){
        if (e.target.className === 'like'){
            like_dislike(post, 0, post.querySelector('.feedback'), e.target);
        }
        else{
            like_dislike(post, 1, post.querySelector('.feedback'), e.target);
        }
    }
    
}

///////////////////////////////////////////////
////////// like or dislike commments //////////
///////////////////////////////////////////////
function    toggle_like_comment(e){
    var post = e.target.closest('.post');
    var comment = e.target.closest('.old_comment');
    if (login !== null){
        if (e.target.className.search('dislike') === -1){
            like_dislike_comment(comment, 0, post.querySelector('.feedback'), e.target);
        }
        else{
            like_dislike_comment(comment, 1, post.querySelector('.feedback'), e.target);
        }
    }
}


/////////////////////////////////////
///// upload new commment ///////////
/////////////////////////////////////
function        submit_new_comment(e){
    e.preventDefault();
    var REG = /^\S.*\S$/;
    var post = e.target.closest('.post');
    var feedback = post.querySelector('.feedback');
    var input = post.querySelector('input[name="comment"]');

    if (!input)
        return ;
    if (input.value.length === 0 || !REG.test(input.value) ||  input.value.length > 250){
       feedback.innerHTML = 'error comment';
       feedback.classList.add('error');
       feedback.classList.remove('success');
    }
    else{
        feedback.classList.remove('error');
        feedback.classList.add('success');
        feedback.innerHTML = '';
        new_comment(input.value, post, feedback);
        input.value = '';
    }
    
}


function        create_popWindow(warning, flag){
    var pop = document.createElement('div');
        pop.classList.add('pop_window');
        pop.classList.add('container');
    
    var msj = document.createElement('h2');
        msj.classList.add('error');
        msj.classList.add('row');
        msj.innerHTML = warning;
        pop.appendChild(msj);

    var btnYse = document.createElement('button');
        btnYse.classList.add('BtnAnim');
        if (flag === true)
            btnYse.addEventListener('click', delet_Post_controller);
        else if (flag === false)
        btnYse.addEventListener('click', delet_comment_controller);
        var r_id = Math.random().toString(36).substr(2, 10);
        while(document.getElementById(r_id)){
            r_id = Math.random().toString(36).substr(2, 10);
        }
        btnYse.setAttribute('id', r_id);
        pop.appendChild(btnYse);
    var labelYes = document.createElement('label');
        labelYes.classList.add('Btn');
        labelYes.classList.add('YESBtn');
        labelYes.classList.add('col-4');
        labelYes.setAttribute('for', r_id);
        labelYes.innerHTML = 'YES';
        pop.appendChild(labelYes);

    var btnNo = document.createElement('button');
        btnNo.classList.add('BtnAnim');
        r_id = Math.random().toString(36).substr(2, 10);
        while(document.getElementById(r_id)){
            r_id = Math.random().toString(36).substr(2, 10);
        }
        btnNo.setAttribute('id', r_id);
        btnNo.addEventListener('click', function(e){
            e.target.closest('.pop_window').remove();
        })
        pop.appendChild(btnNo);

    var labelNO = document.createElement('label');
        labelNO.classList.add('Btn');
        labelNO.classList.add('NOBtn');
        labelNO.classList.add('col-4');
        labelNO.setAttribute('for', r_id);
        labelNO.innerHTML = 'NO';
        pop.appendChild(labelNO);
    
    return(pop);
}


////////////////////////////////////////
/////// init delet post ////////////////
////////////////////////////////////////
function        delet_Post(e){
    var contener = e.target.closest('.post');

    pop_exists = contener.querySelector('.pop_window');
    if (pop_exists === null || pop_exists.closest('.old_comment') !== null){
        contener.insertBefore(create_popWindow('are you sure to delete this posted', true), contener.querySelector('.img_post'));
    }
    else{
        pop_exists.remove();
    }
}

////////////////////////////////////////
//////// init delet comment ////////////
////////////////////////////////////////
function    delet_old_comment(e){
    var contener = e.target.closest('.old_comment');
    if (contener.querySelector('.pop_window') === null){
        contener.appendChild(create_popWindow('are you sure to delete this comment', false));
    }
    else{
        contener.querySelector('.pop_window').remove();
    }
}

/////////////////////////////////////////////////////////////
//////// where page is loaded send request to get update ////
/////////////////////////////////////////////////////////////
window.addEventListener('load', function(){
    socket_post();
});