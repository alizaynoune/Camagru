// function        send_to_backend(url){

// }

// function        get_update(url){

// }


function        delet_post(post){

}


function        new_comment(comment, post, feedback){
    // console.log('her');
    
    var request = new XMLHttpRequest();
    let info = post.querySelector('input[name="post_info"]').value;
    // let login = document.querySelector('.login');
    // login = login !== null ? login.innerHTML : null;
    let url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            let ret = JSON.parse(this.responseText);
            console.log(ret);
            
            if (ret === false){
                feedback.innerHTML = 'invalid information!';
                feedback.classList.add('error');
                feedback.classList.remove('success');
            }
            // else {
            //     update_post_info(post);
            //     post.querySelector('.commentNbr').innerHTML = ret['nbr_comments'] + ' comments';
            // }
            // console.log(ret);
        }
    };


    var data = {'info':info, 'comment':comment, 'type':'comment'};
    var jsn = JSON.stringify(data);
    request.open("Post", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${jsn}`);

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
                // post.querySelector('.contener_like').getElementsByTagName('span')[0].innerHTML = ret['nbr_likes'];
                feedback.innerHTML = 'success';
                feedback.classList.remove('error');
                feedback.classList.add('success');
                // console.log(test);
                
                // .innerHTML = ret['nbr_likes'] + ' comments'
            }
            // console.log(ret);
        }
    };


    var data = {'info':info, 'flag':flag, 'type':'like'};
    var jsn = JSON.stringify(data);
    request.open("Post", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${jsn}`);
}



// function        like_comment(comment){}
// function        dislik_comment(comment){}
// function       delete_comment(comment, post){}


function        socket_post(){
    var i = 10;

    let test = setInterval(function socket(){
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
                    
                    
                }
            };
            var data = {'post':info_post};
            var jsn = JSON.stringify(data);

            request.open('POST', url, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
            request.send(`data=${jsn}`);

            // console.log(i);
            

            // console.log(comments);
        });
        // i--;
        // if (i == 1){
        //     clearInterval(test);
        //     console.log('stop');
        // }
    }, 2000);
    console.log('her');
    
}
