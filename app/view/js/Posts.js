// animation posts

function        toggle_comments(elem){
    let comment = elem.querySelector('.comment');
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

document.querySelectorAll('.post').forEach((e)=> {
    e.querySelectorAll('label').forEach((e)=>{
        if (e.className === 'like' || e.className === 'dislike'){
            // console.log(e);
            // console.log(e.after);
            
            
            e.addEventListener('click', toggle_like, false);
            
        }
        
    });
});