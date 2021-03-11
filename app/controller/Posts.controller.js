// function        send_to_backend(url){

// }

// function        get_update(url){

// }


function        delet_post(post){

}


function        new_comment(comment, post, feedback){
    var request = new XMLHttpRequest();
    let info = post.querySelector('input[name="post_info"]').value;
    let login = document.querySelector('.login');
    login = login !== null ? login.innerHTML : null;
    let url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            ret = JSON.parse(this.responseText);
            if (ret === false){
                feedback.innerHTML = 'nice try agin!';
                feedback.classList.add('error');
                feedback.classList.remove('success');
            }
            console.log(ret);
        }
    };


    var data = {'info':info, 'comment':comment, 'login':login};
    var jsn = JSON.stringify(data);
    request.open("Post", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${jsn}`);

    // return(true);

}



function        like_comment(comment){

}




function        dislik_comment(comment){

}


function       delete_comment(comment, post){

}


function        like_post(post){

}

function        dislik_post(post){

}