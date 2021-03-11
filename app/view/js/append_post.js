



function        new_post(data){
    // console.log(document.querySelector('.login'));
    var login = document.querySelector('.login');
    login = login !== null ? login.innerHTML : login;
    // console.log(login);
    
    

    //create post
    let new_post = document.createElement('div');
        new_post.classList.add('post');


    
    // create input (stor info post)///
    //////////////////////////////////
    let post_info = document.createElement('input');
        post_info.type = 'hidden';
        post_info.name = 'post_info';
        post_info.value = data['id'] + '_leet_' + data['uid'];
        new_post.appendChild(post_info);
    //create div info will has (img_owner, name_owner, title)
    let info = document.createElement('div');
        info.classList.add('info');
        new_post.appendChild(info);
    // create create img (img_owner)
    let img_owner = document.createElement('img');
        img_owner.setAttribute('id', 'img_owner');
        img_owner.src = data['u_avatar'];
        img_owner.addEventListener('click', function(){
            window.location.replace(window.location.origin + `/app/view/php/user.view.php?login=${data['u_name']}`);            
        }, true);
        info.appendChild(img_owner);
    // create h4 hase name of owner
    let name_owner = document.createElement('h4');
        name_owner.classList.add('owner');
        name_owner.innerHTML = data['u_name'];
        name_owner.addEventListener('click', function(){
            window.location.replace(window.location.origin + `/app/view/php/user.view.php?login=${data['u_name']}`);            
        }, true);
        info.appendChild(name_owner);
    // create h2 will has title of post
    let title = document.createElement('h2');
        title.classList.add('title');
        title.innerHTML = data['title'];
        info.appendChild(title);

    // creat date of create post
    let date_post = document.createElement('p');
        let new_time = new Date(data['Date']).toLocaleString('en-US', {hour12: false});
        date_post.innerHTML = new_time;
        info.appendChild(date_post);

    // creat button delet post
    if (login && login === data['u_name']){
        let delet_post = document.createElement('span');
            delet_post.classList.add('delet_post');
            delet_post.addEventListener('click', delet_Post, true);
            info.appendChild(delet_post);
    }
    // create img will hase image of post
    let img_post = document.createElement('img');
        img_post.setAttribute('id', 'img_post');
        img_post.src = data['url'];
        new_post.appendChild(img_post);
    
    // create contener will has (post like, comment)//
    //////////////////////////////////////////////////
    let comment_like = document.createElement('div');
        comment_like.classList.add('comment_like');
        new_post.appendChild(comment_like);

    //create contener like//
    ///////////////////////
    let contener_like = document.createElement('div');
        contener_like.classList.add('contener_like');
        comment_like.appendChild(contener_like);
    
    /// create lable has like or dislike icon [defulte dislike]
    let like = document.createElement('label');
        like.classList.add('dislike');
        login !== null ? like.addEventListener('click', toggle_like, true) :
                        like.addEventListener('click', function(){
                            window.location.replace(window.location.origin + `/app/view/php/login.view.php`);
                        }, true);
        contener_like.appendChild(like);
    ////create span has total number of like [defulte 0]
    let nb_like = document.createElement('span');
        nb_like.innerHTML = data['nbr_likes'];
        contener_like.appendChild(nb_like);

    ///create area of msj error
    let msj_error = document.createElement('h3');
        msj_error.classList.add('error');
        // msj_error.innerHTML = 'msj error';
        contener_like.appendChild(msj_error);

    /// create lable hase total number of comment [defulte 0]
    let nb_comment = document.createElement('lable');
        nb_comment.classList.add('commentNbr');
        nb_comment.innerHTML =  `${data['nbr_comments']} comments`;
        nb_comment.addEventListener('click', toggle_comments, true);
        contener_like.appendChild(nb_comment);
    
        // create contener of comments
    let contener_comment = document.createElement('div');
        contener_comment.classList.add('contener_comment');
        comment_like.appendChild(contener_comment);
    // create contener will has all old comments def [null, hidden]
    let comment = document.createElement('div');
        comment.classList.add('comment');
        comment.classList.add('hidden');
        contener_comment.appendChild(comment);
    
    if (login != null){
        // create contener of new comment
        let new_comment = document.createElement('div');
            new_comment.classList.add('new_comment');
            contener_comment.appendChild(new_comment);

        // create input of new comment
        let input_comment = document.createElement('input');
            input_comment.type = 'text';
            input_comment.name = 'comment';
            input_comment.placeholder = 'add comment';
            input_comment.addEventListener('input', valid_comment, true);
            new_comment.appendChild(input_comment);

        // create contener of submit
        // let contener_submit = document.createElement('div');
        //     new_comment.appendChild(contener_submit); ////////////

        //create input of submit
        let r_id = Math.random().toString(36).substr(2, 10);
        let input_submit = document.createElement('input');
            input_submit.setAttribute('id', r_id);
            input_submit.type = 'submit';
            input_submit.name = 'submit';
            input_submit.value = 'comment';
            input_submit.addEventListener('click', submit_new_comment, false);
            new_comment.appendChild(input_submit);
        
        // create lable of submit 
        let lable_submit = document.createElement('label');
            lable_submit.setAttribute('id', 'submit');
            lable_submit.setAttribute('for', r_id);
            new_comment.appendChild(lable_submit);
    }

    return(new_post);
}