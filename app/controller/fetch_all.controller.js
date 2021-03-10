// var     lastdate = '0';
// var     contener = document.querySelector('.content');

// function       send_request(){
    
//     let request = new XMLHttpRequest();
//     let url = '../../model/fetch_all.model.php';
//     request.open('Post', url, true);
//     request.responseType = 'text';
//     request.onload = function(){
//         try{
//             var ret = JSON.parse(this.responseText);
//             var packge = document.createElement('div');
//             packge.classList.add('packge');
//             ret.forEach(element => {
//                 let post = new_post(element, null);
//                 if (post != null){
//                     packge.appendChild(post);
//                     lastdate = element['Date'];
//                 }
                
//             });
//             contener.appendChild(packge);
//             // console.log(lastdate);
//         }catch(e){
//             // console.log(e);
            
//         }
//     };
//     request.onerror = function(){
//         // console.log('error');
        
//     };
//     request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded' );
//     request.send(`lastdate=${lastdate}`);
// }

// window.addEventListener('load', function(){
//     send_request(0);
// });

// window.addEventListener('scroll', function(e){
//     let tst = Math.ceil(window.innerHeight + window.pageYOffset);
//     if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
//         send_request();
//     }
// });