
function       request_profile(login, date, contener){
    
    let request = new XMLHttpRequest();
    let url = `../../model/fetch_data.model.php?type=profile&login=${login}&lastdate=${date}`;
    request.open('GET', url, true);
    request.responseType = 'text';
    request.onload = function(){
        try{
            var ret = JSON.parse(this.responseText);
            var packge = document.createElement('div');
            packge.classList.add('packge');
            ret.forEach(element => {
                let post = new_post(element, null);
                packge.appendChild(post);
                lastdate = element['Date'];
                
            });
            contener.appendChild(packge);
        }catch(e){            
        }
    };
    request.onerror = function(){
        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}


function       request_all(date, contener){
    
    let request = new XMLHttpRequest();
    let url = `../../model/fetch_data.model.php?type=all&lastdate=${date}`;
    request.open('GET', url, true);
    request.responseType = 'text';
    request.onload = function(){
        try{
            var ret = JSON.parse(this.responseText);
            var packge = document.createElement('div');
            packge.classList.add('packge');
            ret.forEach(element => {
                let post = new_post(element, null);
                if (post != null){
                    packge.appendChild(post);
                    lastdate = element['Date'];
                }
                
            });
            contener.appendChild(packge);
        }catch(e){
            
        }
    };
    request.onerror = function(){        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}


function        request_comment(pid, contener){
    
    var request = new XMLHttpRequest();
    let url = window.location.origin + `/app/model/fetch_data.model.php?type=comment&pid=${pid}`;
    request.responseType = 'text';
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            ret = JSON.parse(this.responseText);
            ret.forEach((e)=>{
                append_comment(e, contener);
                
            });
        }
    };
    request.open("GET", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}


