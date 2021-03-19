
/////////////////////////////////////
//////// delete post ////////////////
/////////////////////////////////////

function        delet_Post_controller(e){
    post = e.target.closest('.post');
    post_info = post.querySelector('input[name="post_info"]').value;
    if (post_info !== null){
        var request = new XMLHttpRequest();
        var url = window.location.origin + '/app/model/posts.model.php';
        request.responseType = 'text';
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                var ret = JSON.parse(this.responseText);
                if (ret === false){
                    var feed = post.querySelector('.feedback');
                    feed.innerHTML = 'Permission denied';
                    feed.classList.remove('success');
                    feed.classList.add('error');
                }
                else{
                    post.remove();
                }
            }
        };
        var data = JSON.stringify({'info':post_info, 'type':'delet_post'});
        request.open('POST', url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
        request.send(`data=${data}`);
    }
}


////////////////////////////
//// add new comment ///////
////////////////////////////

function        new_comment(comment, post, feedback){
    var request = new XMLHttpRequest();
    var info = post.querySelector('input[name="post_info"]').value;
    var url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var ret = JSON.parse(this.responseText);            
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


///////////////////////////
//like or dislike posts////
///////////////////////////

function        like_dislike(post, flag, feedback){
    var info = post.querySelector('input[name="post_info"]').value;
    var request = new XMLHttpRequest();
    var url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var ret = JSON.parse(this.responseText);
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


///////////////////////////////
/////// delect comment ////////
///////////////////////////////
function    delet_comment_controller(e){
    var comment = e.target.closest('.old_comment');
    var post = e.target.closest('.post');
    var info = comment.querySelector('input[name="comment_info"]').value;
    // console.log(info);
    if (info !== null){
        var request = new XMLHttpRequest();
        var url = window.location.origin + '/app/model/posts.model.php';
        request.responseType = 'text';
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                var ret = JSON.parse(this.responseText);
                if (ret === false){
                    var feed = post.querySelector('.feedback');
                    feed.innerHTML = 'Permission denied';
                    feed.classList.remove('success');
                    feed.classList.add('error');
                }
                else{
                    comment.remove();
                }
            }
        };
        var data = JSON.stringify({'info':info, 'type':'delet_comment'});
        request.open('POST', url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
        request.send(`data=${data}`);
    }
    
    
}


//////////////////////////////
// like or dislike comments///
//////////////////////////////

function        like_dislike_comment(comment, flag, feedback){
    var info = comment.querySelector('input[name="comment_info"]').value;
    var    request = new XMLHttpRequest();
    var url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var ret = JSON.parse(this.responseText);
            if (ret === false){
                feedback.innerHTML = 'invalid information!';
                feedback.classList.add('error');
                feedback.classList.remove('success');
            }
        }
    };
    var data = JSON.stringify({'info':info, 'flag':flag, 'type':'like_comment'});
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${data}`);
}


///////////////////////////////
///socket (posts && commets)///
///////////////////////////////

function        socket_post(){

    // var time_soket = setInterval(function socket(){
        document.querySelectorAll('.post').forEach((e)=>{
            var rect = e.getBoundingClientRect();
            if (rect.y <= window.innerHeight && rect.bottom > 0){
                
                
                var info_post = e.querySelector('input[name="post_info"]').value;
                var request = new XMLHttpRequest();
                request.response = 'text';
                var url = window.location.origin + '/app/model/socket_post.model.php';
                request.open('POST', url, true);
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded" );
                request.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        var ret = JSON.parse(this.responseText);
                        // console.log(ret);
                        
                        if (ret !== false)
                            update_post_info(ret);
                        else{
                            e.remove();
                        }
                        // console.log(e);
                        // console.log(e.getBoundingClientRect());
                        // console.log(window.innerHeight);

                        // console.log('==============================');

                    }
                    // else if (this.readyState == 4 && this.status != 200){
                    //     clearInterval(time_soket);
                    //     // console.log(this.readyState, this.status);
                    //     // console.log('error');
                    //     var msj = document.querySelector('.navBar').querySelector('.global_msj');
                    //     msj.innerHTML = 'Error Connection plaes check your connection and relaod page';
                    //     msj.classList.add('error');


                    // }
                };
                request.onerror = function(){
                    var msj = document.querySelector('.navBar').querySelector('.global_msj');
                    msj.innerHTML = 'Error Connection plaes check your connection and relaod page';
                    msj.classList.add('error');
                };
                var data = JSON.stringify({'post':info_post});
                request.send(`data=${data}`);
            }
        });
    // }, 1500);
}
