// animation posts

function        toggle_comments(elem){
    let comment = elem.target.parentNode.parentNode.querySelector('.comment');
    comment.classList.toggle('hidden');
    console.log(comment);
    
    
    
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

    
    
}

function        new_comment(e){
    // console.log(e);
    console.log('her');
    
}


/////////// document ready/////////////////////////////

document.querySelectorAll('.post').forEach((e)=> {
    e.querySelectorAll('label').forEach((el)=>{
        if (el.className === 'like' || el.className === 'dislike'){
            el.addEventListener('click', toggle_like, false);
            
        }

        else if (el.className === 'commentNbr'){
            // console.log('test');
            
            el.addEventListener('click', toggle_comments, false);
        }
        // console.log(el.className);
        
        
    });
    e.querySelector('.new_comment').addEventListener('click', new_comment, false);
    var input = e.querySelector('input[name="comment"]');
    console.log(input);
    
    // e.querySelectorAll('.new_comment').forEach((elem)=>{
        // console.log(submit);
    //     elem.querySelector()
    
    
        
    // });
    
});
