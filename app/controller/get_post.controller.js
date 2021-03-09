
window.addEventListener('load', function(){
    console.log('load');
    let request = new XMLHttpRequest();
    let url = '../../model/get_post_profile.model.php';
    request.open('POST', url);
    request.responseType = 'text';
    request.onload = function(){
        try{
            var ret = JSON.parse(this.responseText);
            var page = document.querySelector('.content');
            var packge = document.createElement('div');
            packge.classList.add('packge');
            ret.forEach(element => {
                let post = new_post(element, null);
                packge.insertBefore(post, packge.firstChild);
                
            });
            page.appendChild(packge);
        }catch(e){
            console.log(e);
        }
    };


    
    request.send();
    
});

var rendom = Math.random().toString(36).substring(3);
console.log(rendom);