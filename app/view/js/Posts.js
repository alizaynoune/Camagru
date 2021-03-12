// animation posts
var login = document.querySelector('.login');
login = login !== null ? login.innerHTML : login;


function        valid_comment(elem){
    let REG = /^[\w\d\-_\ @.]+$/;
    if (elem.target.value.length === 0){
        return false;
    }
    if (!REG.test(elem.target.value) || elem.target.value.length > 50 ){
        elem.target.classList.add('error');
        return false;
    }
    else{
        elem.target.classList.remove('error');
        return true;
    }
}



function        toggle_comments(elem){
    // let comment = elem.target.parentNode.parentNode.querySelector('.comment');
    let post = elem.target.closest('.post');
    let comment = post.querySelector('.comment');
    comment.classList.toggle('hidden');
    // console.log('toggle comment');
    // console.log(comment);
    
    
    
    
}

function        toggle_like(e){
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

function        submit_new_comment(e){
    let REG = /^[\w\d\-_\ @.]+$/;
    let post = e.target.closest('.post');
    let feedback = post.querySelector('.feedback');
    let input = post.querySelector('input[name="comment"]');
    // let login = ;//////////get login


    if (input.value.length === 0 || !REG.test(input.value) || input.value.length > 50 ){
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

function        delet_Post(e){
    console.log('delet Post');
}

function    update_comment(){

}

function    update_likes(){

}


/////////// document ready/////////////////////////////

// document.querySelectorAll('.post').forEach((e)=> {
//     e.querySelectorAll('label').forEach((el)=>{
//         if (el.className === 'like' || el.className === 'dislike'){
//             el.addEventListener('click', toggle_like, false);
            
//         }

//         else if (el.className === 'commentNbr'){
//             // console.log('test');
            
//             el.addEventListener('click', toggle_comments, false);
//         }
//         // console.log(el.className);
        
        
//     });
//     e.querySelector('.new_comment').addEventListener('click', new_comment, false);
//     var input = e.querySelector('input[name="comment"]');
//     // console.log(input);
    
//     // e.querySelectorAll('.new_comment').forEach((elem)=>{
//         // console.log(submit);
//     //     elem.querySelector()
    
    
        
//     // });
    
// });


