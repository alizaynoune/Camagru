


function        delet_Post_controller(e){
    post = e.target.closest('.post');
    post_info = post.querySelector('input[name="post_info"]').value;
    if (post_info !== null){
        let request = new XMLHttpRequest();
        let url = window.location.origin + '/app/model/posts.model.php';
        request.responseType = 'text';
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                let ret = JSON.parse(this.responseText);
                if (ret === false){
                    let feed = post.querySelector('.feedback');
                    feed.innerHTML = 'ivalid information';
                    feed.classList.remove('success');
                    feed.classList.add('error');
                }
                else{
                    post.remove();
                }
            }
        };
        let data = JSON.stringify({'info':post_info, 'type':'delet_post'});
        request.open('POST', url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
        request.send(`data=${data}`);
    }
    
    
}


function        new_comment(comment, post, feedback){
    var request = new XMLHttpRequest();
    let info = post.querySelector('input[name="post_info"]').value;
    let url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            let ret = JSON.parse(this.responseText);            
            if (ret === false){
                feedback.innerHTML = 'invalid information!';
                feedback.classList.add('error');
                feedback.classList.remove('success');
            }
        }
    };
    var data = JSON.stringify({'info':info, 'comment':comment, 'type':'comment'});
    request.open("POST", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${data}`);

}


function        like_dislike(post, flag, feedback){
    let info = post.querySelector('input[name="post_info"]').value;
    let request = new XMLHttpRequest();
    let url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            let ret = JSON.parse(this.responseText);
            if (ret === false){
                feedback.innerHTML = 'invalid information!';
                feedback.classList.add('error');
                feedback.classList.remove('success');
            }
            else {
                feedback.innerHTML = 'success';
                feedback.classList.remove('error');
                feedback.classList.add('success');
            }
        }
    };
    var data = JSON.stringify({'info':info, 'flag':flag, 'type':'like'});
    request.open("POST", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${data}`);
}


function        socket_post(){

    setInterval(function socket(){
        document.querySelectorAll('.post').forEach((e)=>{
            let info_post = e.querySelector('input[name="post_info"]').value;

            var request = new XMLHttpRequest();
            request.response = 'text';
            let url = window.location.origin + '/app/model/socket_post.model.php';
            request.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    let ret = JSON.parse(this.responseText);
                    // console.log(ret);
                    if (ret !== false)
                        update_post_info(ret);
                    else{
                        e.remove();
                    }
                    
                    
                }
            };
            var data = JSON.stringify({'post':info_post});
            request.open('POST', url, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
            request.send(`data=${data}`);
        });
    }, 3000);   
}
