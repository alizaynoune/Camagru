// animation posts

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
    let comment = elem.target.parentNode.parentNode.querySelector('.comment');
    comment.classList.toggle('hidden');
    console.log('toggle comment');
    
    
    
}

function        toggle_like(e){
    if (e.target.className === 'like'){
        e.target.classList.remove('like');
        e.target.classList.add('dislike');
    }

    else{
        e.target.classList.remove('dislike');
        e.target.classList.add('like');
    }
    console.log('like dislike');

    
    
}

function        submit_new_comment(e){
    let REG = /^[\w\d\-_\ @.]+$/;
    let contener = e.target.parentNode.parentNode.parentNode;
    let _error = contener.querySelector('.error');
    let input = contener.querySelector('input[name="comment"]');


    if (input.value.length === 0 || !REG.test(input.value) || input.value.length > 50 ){
       _error.innerHTML = 'error comment';
    }
    else{
        new_comment(input.value);
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


