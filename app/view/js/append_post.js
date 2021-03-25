
////////////////////////////////////////////////////////
/// update post (comments & likes) & comments (likes)///
////////////////////////////////////////////////////////
function       update_post_info(data){
    var target = document.querySelector(`input[value='${data['post_info']}']`);
    if (target === null)
        return (false);
    var post = target.closest('.post');
    var likes_comments = post.querySelector('.contener_like');
    var likes = likes_comments.getElementsByTagName('label')[0];
    likes.innerHTML = data['likes_comments']['nbr_likes'];
    if (data['likes_comments']['is_like'] === '1'){
        likes.classList.remove('dislike');
        likes.classList.add('like');
    }
    else{
        likes.classList.remove('like');
        likes.classList.add('dislike');
    }
    likes_comments.getElementsByTagName('label')[1].innerHTML = data['likes_comments']['nbr_comments'];
    var i = 0;
    var all_old_comment = post.querySelectorAll('.old_comment');
    for(j = 0; j < all_old_comment.length; j++) {
        var e = all_old_comment[j];
        var info = e.querySelector('input[name="comment_info"]').value;
        if (i < data['all_comments'].length){
            var cmp = data['all_comments'][i]['id'] + '_leet_' + data['all_comments'][i]['pid'] + '_leet_' + data['all_comments'][i]['uid'];
            if (info === cmp){
                var like = e.getElementsByTagName('label')[0];
                like.innerHTML = data['all_comments'][i]['nbr_likes'];
                if (data['all_comments'][i]['is_like'] === '1'){
                    like.classList.remove('dislike');
                    like.classList.add('like');
                }
                else {
                    like.classList.remove('like');
                    like.classList.add('dislike');
                }
                i++;
            }
            else
                e.remove();
        }
        else
            e.remove();
    }
    if (i < data['all_comments'].length){
        var contener = post.querySelector('.comment');
        while(i < data['all_comments'].length){
            append_comment(data['all_comments'][i++], contener)
        }
    }
}

////////////////////////////////////////
////// create new commment /////////////
////////////////////////////////////////
function        append_comment(comment, contener){
    var login = document.querySelector('input[name="_USER_LOGIN_"]');
    var post = contener.closest('.post');
    var owner_post = post.querySelector('.owner').innerHTML;
    login = login !== null ? login.value : login;

    // Create contener of old comment
    var old_comment = document.createElement('div');
        old_comment.classList.add('old_comment');
        old_comment.classList.add('row');
        contener.appendChild(old_comment);

    //Creat input for comment info
    var comment_info = document.createElement('input');
        comment_info.type = 'hidden';
        comment_info.name = 'comment_info';
        comment_info.value = comment['id'] + '_leet_' + comment['pid'] + '_leet_'  + comment['uid'];        
        old_comment.appendChild(comment_info);

    //Creat like / dislike of comment
    var like_comment = document.createElement('label');
        like_comment.innerHTML = comment['nbr_likes'];
        like_comment.classList.add('col-1');
        if (login === null){
            like_comment.classList.add('dislike');
            like_comment.addEventListener('click', function(){
                window.location.replace(window.location.origin + `/app/view/php/login.view.php`);
            }, true);
        }
        else {
            comment['is_like'] === '1' ? like_comment.classList.add('like') : like_comment.classList.add('dislike');
            like_comment.addEventListener('click', toggle_like_comment, true);
        }
        old_comment.appendChild(like_comment);
    
    /// Create h4 will has login owner of this comment
    var owner_comment = document.createElement('h4');
        owner_comment.innerHTML = comment['owner'];
        owner_comment.classList.add('col');
        owner_comment.addEventListener('click', function(){
            window.location.replace(window.location.origin + `/app/view/php/user.view.php?login=${comment['owner']}`);            
        }, true);
        old_comment.appendChild(owner_comment);
        
    //create p will has date create comment
    var date_comment = document.createElement('p');
        date_comment.classList.add('col');
        date_comment.innerHTML = comment['Date'];
        old_comment.appendChild(date_comment);
    if (login !== null && (login === comment['owner'] || login === owner_post)){
        /// Create span of delete this comment
        var delet_comment = document.createElement('span');
            delet_comment.classList.add('delet_comment');
            delet_comment.addEventListener('click', delet_old_comment, true);
            old_comment.appendChild(delet_comment);
    }
    /// Create p to stored comment
    var comment_p = document.createElement('p');
        comment_p.classList.add('col-12');
        comment_p.innerHTML = comment['Comment'];
        old_comment.appendChild(comment_p);
}



///////////////////////////////////////////////////////////////////////
/////////////////////// create new post ///////////////////////////////
///////////////////////////////////////////////////////////////////////
function        new_post(data){
    var login = document.querySelector('.login');
    login = login !== null ? login.innerHTML : login;
    var class_name = null;

    //create post
    var new_post = document.createElement('div');
        class_name = ['post', 'col-11', 'col-sm-11', 'col-md-10', 'col-lg-5', 'col-xl-5'];
        for(var i = 0; i < class_name.length; i++){
            new_post.classList.add(class_name[i]);
        }
        class_name = null;
        
    
    // create input (stor info post)///
    //////////////////////////////////
    var post_info = document.createElement('input');
        post_info.type = 'hidden';
        post_info.name = 'post_info';
        post_info.value = data['id'] + '_leet_' + data['uid'];
        new_post.appendChild(post_info);

    //create div info will has (img_owner, name_owner, title)
    var info = document.createElement('div');
        class_name = ['info', 'row', 'card-header', 'justify-content-center'];
        for (var i = 0; i < class_name.length; i++){
            info.classList.add(class_name[i]);
        }
        new_post.appendChild(info);

    // create create img (img_owner)
    var img_owner = document.createElement('img');
        // img_owner.setAttribute('id', 'img_owner');
        img_owner.classList.add('img_owner');
        img_owner.src = data['u_avatar'];
        img_owner.addEventListener('click', function(){
            window.location.replace(window.location.origin + `/app/view/php/user.view.php?login=${data['u_name']}`);            
        }, true);
        info.appendChild(img_owner);

    // create h4 hase name of owner
    var name_owner = document.createElement('h4');
        name_owner.classList.add('owner');
        name_owner.innerHTML = data['u_name'];
        name_owner.addEventListener('click', function(){
            window.location.replace(window.location.origin + `/app/view/php/user.view.php?login=${data['u_name']}`);            
        }, true);
        info.appendChild(name_owner);

    // creat date of create post
    var date_post = document.createElement('p');
        date_post.innerHTML = data['Date'];
        date_post.classList.add('col');
        info.appendChild(date_post);

    // creat button delet post
    if (login && login === data['u_name']){
        var delet_post = document.createElement('span');
            delet_post.classList.add('delet_post');
            delet_post.addEventListener('click', delet_Post, true);
            info.appendChild(delet_post);
    }

    // create h2 will has title of post
    var title = document.createElement('h4');
        title.classList.add('title');
        title.classList.add('col-9');
        title.innerHTML = data['title'];
        info.appendChild(title);

    // create img will hase image of post
    var img_post = document.createElement('img');
        img_post.classList.add('img_post');
        img_post.classList.add('card-img');
        img_post.src = data['url'];
        new_post.appendChild(img_post);
    
    // create contener will has (post like, comment)//
    //////////////////////////////////////////////////
    var comment_like = document.createElement('div');
        class_name = ['comment_like', 'card-body', 'col'];
        for(var i = 0; i < class_name.length; i++){
            comment_like.classList.add(class_name[i]);
        }
        class_name = null;
        new_post.appendChild(comment_like);

    //create contener like//
    ///////////////////////
    var contener_like = document.createElement('div');
        class_name = ['contener_like', 'row', 'justify-content-between'];
        for(var i = 0; i < class_name.length; i++){
           contener_like.classList.add(class_name[i]); 
        }
        class_name = null;
        comment_like.appendChild(contener_like);
    
    /// create lable has like or dislike icon [defulte dislike]
    var like = document.createElement('label');
        like.innerHTML = data['nbr_likes'];
        if (login === null){
            like.classList.add('dislike');
            like.addEventListener('click', function(){
                window.location.replace(window.location.origin + `/app/view/php/login.view.php`);
            }, true);
        }
        else {
            data['is_like'] === '1' ? like.classList.add('like') : like.classList.add('dislike');
            like.addEventListener('click', toggle_like_post, true);
        }
        contener_like.appendChild(like);
    ///create area of msj error
    var msj_error = document.createElement('h3');
        msj_error.classList.add('feedback');
        // msj_error.innerHTML = 'msj error';
        contener_like.appendChild(msj_error);

    /// create lable hase total number of comment [defulte 0]
    var nb_comment = document.createElement('label');
        nb_comment.classList.add('commentNbr');
        nb_comment.innerHTML =  data['nbr_comments'];
        nb_comment.addEventListener('click', toggle_comments, true);
        contener_like.appendChild(nb_comment);
    
        // create contener of comments
    var contener_comment = document.createElement('div');
        contener_comment.classList.add('contener_comment');
        contener_comment.classList.add('row');
        comment_like.appendChild(contener_comment);
    // create contener will has all old comments def [null, hidden]
    var comment = document.createElement('div');
        comment.classList.add('comment');
        comment.classList.add('col-12');
        comment.classList.add('hidden');
        contener_comment.appendChild(comment);
        
        if (parseInt(data['nbr_comments'], 10) > 0){
            // fetche comment of post
            request_comment(data['id'], comment);
        }
    if (login !== null){
        /// create form
        var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            contener_comment.appendChild(form);


        // create contener of new comment
        var new_comment = document.createElement('div');
            new_comment.classList.add('new_comment');
            form.appendChild(new_comment);

        // create input of new comment
        var input_comment = document.createElement('input');
            input_comment.type = 'text';
            input_comment.name = 'comment';
            input_comment.placeholder = 'add comment';
            input_comment.addEventListener('input', valid_comment, true);
            new_comment.appendChild(input_comment);

        //create input of submit
        var r_id = Math.random().toString(36).substr(2, 10);
        while(document.getElementById(r_id)){
            r_id = Math.random().toString(36).substr(2, 10);
        }
        var input_submit = document.createElement('input');
            input_submit.setAttribute('id', r_id);
            input_submit.type = 'submit';
            input_submit.name = 'submit';
            input_submit.value = 'comment';
            input_submit.addEventListener('click', submit_new_comment, false);
            new_comment.appendChild(input_submit);
        
        // create lable of submit 
        var lable_submit = document.createElement('label');
            // lable_submit.setAttribute('id', 'submit');
            lable_submit.setAttribute('for', r_id);
            new_comment.appendChild(lable_submit);
    }

    return(new_post);
}


/////////////////////////////////////////////////////////////////////
//////////// Creat post just img for chose one as avatar ////////////
/////////////////////////////////////////////////////////////////////

function            new_chose_avatar(data){
    var contener = document.createElement('div');
        // contener.classList.add('post');
        var class_name = ['post', 'col-11', 'col-sm-11', 'col-md-5', 'col-lg-5', 'col-xl-5'];
        for(var i = 0; i < class_name.length; i++){
            contener.classList.add(class_name[i]);
        }

    var id = document.createElement('input');
        id.type = 'hidden';
        id.name = 'info';
        id.value = data['id'];
        contener.appendChild(id);

    
    var img = document.createElement('img');
        img.classList.add('img_post');
        img.src = data['url'];
        img.addEventListener('click', select_avatar, true);
        contener.appendChild(img);

    return(contener);
}