
////////////////////////////////////////////////////////////////
//////// send request fetch last (5) post of profile X /////////
////////////////////////////////////////////////////////////////
function       request_profile(login, date, contener){
    var request = new XMLHttpRequest();
    var url = `../../model/fetch_data.model.php?type=profile&login=${login}&lastdate=${date}`;
    request.open('GET', url, true);
    request.responseType = 'text';
    request.onload = function(){
        try{
            var ret = JSON.parse(this.responseText);
            if (ret.length < 5){
                var load = document.querySelector('.load_more');
                if (load !== null)
                    load.classList.add('hidden');
            }
            for(var i = 0; i < ret.length; i++) {
                element = ret[i];
                var post = new_post(element, null);
                contener.appendChild(post);
                lastdate = element['Date'];
                
            }
        }catch(e){
            document.querySelector('.global_msj').innerHTML = 'error profile dont exist';
            var load = document.querySelector('.load_more');
            if (load !== null)
                load.classList.add('hidden');       
        }
    };
    request.onerror = function(){
        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}

///////////////////////////////////////////////////////////////////////
/////////// send request fetch last (5) post from all users ///////////
///////////////////////////////////////////////////////////////////////
function       request_all(date, contener){
    
    var request = new XMLHttpRequest();
    var url = `../../model/fetch_data.model.php?type=all&lastdate=${date}`;
    request.open('GET', url, true);
    request.responseType = 'text';
    request.onload = function(){
        try{
            var ret = JSON.parse(this.responseText);
            if (ret.length < 5){
                var load = document.querySelector('.load_more');
                if (load !== null)
                    load.classList.add('hidden');
            }
            for(var i = 0; i < ret.length; i++){
                element = ret[i];
                var post = new_post(element, null);
                if (post != null){
                    contener.appendChild(post);
                    lastdate = element['Date'];
                }
                
            }
        }catch(e){
            document.querySelector('.global_msj').innerHTML = 'error in fetch data';
            var load = document.querySelector('.load_more');
            if (load !== null)
                load.classList.add('hidden');
        }
    };
    request.onerror = function(){        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}

////////////////////////////////////////////////////////
///////// send request all comments of post ////////////
////////////////////////////////////////////////////////
function        request_comment(pid, contener){
    
    var request = new XMLHttpRequest();
    var url = window.location.origin + `/app/model/fetch_data.model.php?type=comment&pid=${pid}`;
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            try{
                ret = JSON.parse(this.responseText);
                for(var i = 0; i < ret.length; i++){
                    append_comment(ret[i], contener);

                }
            }catch(e){
                document.querySelector('.global_msj').innerHTML = 'error in fetch comments'; 
            }
        }
    };
    request.open("GET", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}


//////////////////////////////////////////////////////////////
/////////// sed request get img post by id login /////////////
//////////////////////////////////////////////////////////////

function        request_profile_id(date, contener){
    var request = new XMLHttpRequest();
    var url = window.location.origin + `/app/model/fetch_data.model.php?type=profil_login&lastdate=${date}`;
    request.responseType = 'text';
    request.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200){
            try{
                ret = JSON.parse(this.responseText);
                if (ret.length < 5){
                    var load = document.querySelector('.load_more');
                    if (load !== null)
                        load.classList.add('hidden');
                }
                if (ret.length > 0){
                    lastdate = ret[ret.length - 1]['date'];
                }
                for(var i = 0; i < ret.length; i++){
                    var new_img = new_chose_avatar(ret[i]);
                    contener.appendChild(new_img);
                }
            }catch(e){
                document.querySelector('.global_msj').innerHTML = 'error profile dont exist';
                var load = document.querySelector('.load_more');
                if (load !== null)
                    load.classList.add('hidden');
            }
        }
    };
    request.open('GET', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send();
}