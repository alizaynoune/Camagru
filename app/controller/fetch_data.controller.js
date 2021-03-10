function       request_profile(login, date, contener){
    
    let request = new XMLHttpRequest();
    let url = `../../model/fetch_profile.model.php?login=${login}&lastdate=${date}`;
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
            // console.log(lastdate);
        }catch(e){
            // console.log(e);
            
        }
    };
    request.onerror = function(){
        // console.log('error');
        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}


function       request_all(date, contener){
    
    let request = new XMLHttpRequest();
    let url = `../../model/fetch_all.model.php?lastdate=${date}`;
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
            // console.log(lastdate);
        }catch(e){
            // console.log(e);
            
        }
    };
    request.onerror = function(){
        // console.log('error');
        
    };
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
    request.send();
}