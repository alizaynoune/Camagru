// function        send_to_backend(url){

// }

// function        get_update(url){

// }


function        delet_post(post){

}


function        new_comment(comment, post){
    var request = new XMLHttpRequest();
    let info = post.querySelector('input[name="post_info"]').value;
    let url = window.location.origin + '/app/model/posts.model.php';
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            ret = JSON.parse(this.responseText);
            console.log(ret);
            // console.log(comment);
            // console.log(info);
            
            
            
            // return(ret);
        }
    };


    var data = {'info':info, 'comment':comment};
    var jsn = JSON.stringify(data);
    request.open("Post", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send(`data=${jsn}`);
    


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