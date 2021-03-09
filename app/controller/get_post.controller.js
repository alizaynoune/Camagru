window.addEventListener('load', function(){
    console.log('load');
    let request = new XMLHttpRequest();
    let url = '../../model/get_post_profile.model.php';
    request.open('POST', url);
    request.responseType = 'text';
    request.send();
    
});