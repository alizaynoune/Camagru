///////////////////////////////////////
/////// get login user ////////////////
///////////////////////////////////////
var login = document.querySelector('.login');
login = login !== null ? login.innerHTML : login;


///////////////////////////////////////////
//////// valid input value of comments ////
///////////////////////////////////////////
function        valid_comment(elem){
    let REG = /^\S.*\S$/;
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
    // let comment = elem.target.parentNode.parentNode.querySelector('.comment');
    let post = elem.target.closest('.post');
    let comment = post.querySelector('.comment');
    comment.classList.toggle('hidden');
    // console.log('toggle comment');
    // console.log(comment);
    
    
    
    
}

////////////////////////////////////////////
////////// like or dislike post ////////////
////////////////////////////////////////////
function        toggle_like_post(e){
    let post = e.target.closest('.post');
    if (login !== null){
        if (e.target.className === 'like'){
            e.target.classList.remove('like');
            e.target.classList.add('dislike');
            like_dislike(post, 0, post.querySelector('.feedback'));
        }
        else{
            e.target.classList.remove('dislike');
            e.target.classList.add('like');
            like_dislike(post, 1, post.querySelector('.feedback'));
        }
        // console.log();
    }
    
}

///////////////////////////////////////////////
////////// like or dislike commments //////////
///////////////////////////////////////////////
function    toggle_like_comment(e){
    let post = e.target.closest('.post');
    let comment = e.target.closest('.old_comment');
    if (login !== null){
        if (e.target.className === 'like'){
            e.target.classList.remove('like');
            e.target.classList.add('dislike');
            like_dislike_comment(comment, 0, post.querySelector('.feedback'));
        }
        else{
            e.target.classList.remove('dislike');
            e.target.classList.add('like');
            like_dislike_comment(comment, 1, post.querySelector('.feedback'));
        }
    }
    // console.log(comment);
    
}


/////////////////////////////////////
///// upload new commment ///////////
/////////////////////////////////////
function        submit_new_comment(e){
    e.preventDefault();
    let REG = /^\S.*\S$/;
    let post = e.target.closest('.post');
    let feedback = post.querySelector('.feedback');
    let input = post.querySelector('input[name="comment"]');


    if (input.value.length === 0 || !REG.test(input.value) ||  input.value.length > 250){
       feedback.innerHTML = 'error comment';
       feedback.classList.add('error');
       feedback.classList.remove('success');
    }
    else{
        feedback.classList.remove('error');
        feedback.classList.add('success');
        feedback.innerHTML = 'Success comment';
        new_comment(input.value, post, feedback);
        input.value = '';
    }
    
}

////////////////////////////////////////
/////// init delet post ////////////////
////////////////////////////////////////
function        delet_Post(e){
    let contener = e.target.closest('.post');
    // console.log(contener);
    
    
    pop_exists = contener.querySelector('.pop_window');
    if (pop_exists === null || pop_exists.closest('.old_comment') !== null){
        let pop = document.createElement('div');
            pop.classList.add('pop_window');
            contener.insertBefore(pop, contener.querySelector('.img_post'));
        let btnYse = document.createElement('button');
            btnYse.classList.add('BtnAnim');
            btnYse.addEventListener('click', delet_Post_controller);
            let r_id = Math.random().toString(36).substr(2, 10);
            while(document.getElementById(r_id)){
                r_id = Math.random().toString(36).substr(2, 10);
            }
            btnYse.setAttribute('id', r_id);
            pop.appendChild(btnYse);
        let labelYes = document.createElement('label');
            labelYes.classList.add('Btn');
            labelYes.classList.add('YESBtn');
            labelYes.setAttribute('for', r_id);
            labelYes.innerHTML = 'YES';
            pop.appendChild(labelYes);
            
        
        let msj = document.createElement('h2');
            msj.classList.add('error');
            msj.innerHTML = 'are you sure to delete this posted';
            pop.appendChild(msj);
        

        let btnNo = document.createElement('button');
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
        
        let labelNO = document.createElement('label');
            labelNO.classList.add('Btn');
            labelNO.classList.add('NOBtn');
            labelNO.setAttribute('for', r_id);
            labelNO.innerHTML = 'NO';
            pop.appendChild(labelNO);
            // contener.appendChild(pop);
    }
    else{
        pop_exists.remove();
    }
}

////////////////////////////////////////
//////// init delet comment ////////////
////////////////////////////////////////
function    delet_old_comment(e){
let contener = e.target.closest('.old_comment');
if (contener.querySelector('.pop_window') === null){
    let pop = document.createElement('div');
        pop.classList.add('pop_window');
        contener.appendChild(pop);
    let btnYse = document.createElement('button');
        btnYse.classList.add('BtnAnim');
        btnYse.addEventListener('click', delet_comment_controller);
        let r_id = Math.random().toString(36).substr(2, 10);
        while(document.getElementById(r_id)){
            r_id = Math.random().toString(36).substr(2, 10);
        }
        btnYse.setAttribute('id', r_id);
        pop.appendChild(btnYse);
    let labelYes = document.createElement('label');
        labelYes.classList.add('Btn');
        labelYes.classList.add('YESBtn');
        labelYes.setAttribute('for', r_id);
        labelYes.innerHTML = 'YES';
        pop.appendChild(labelYes);


    let msj = document.createElement('h2');
        msj.classList.add('error');
        msj.innerHTML = 'are you sure to delete this comment';
        pop.appendChild(msj);


    let btnNo = document.createElement('button');
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

    let labelNO = document.createElement('label');
        labelNO.classList.add('Btn');
        labelNO.classList.add('NOBtn');
        labelNO.setAttribute('for', r_id);
        labelNO.innerHTML = 'NO';
        pop.appendChild(labelNO);
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