// var     lastdate = '0';

// var     login = document.querySelector('input[name="login"]').value;

// function       send_request(login, date, contener){
    
//     let request = new XMLHttpRequest();
//     let url = `../../model/fetch_profile.model.php?login=${login}&lastdate=${date}`;
//     request.open('Post', url, true);
//     request.responseType = 'text';
//     request.onload = function(){
//         try{
//             var ret = JSON.parse(this.responseText);
//             var packge = document.createElement('div');
//             packge.classList.add('packge');
//             ret.forEach(element => {
//                 let post = new_post(element, null);
//                 packge.appendChild(post);
//                 lastdate = element['Date'];
                
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
//     send_request(login, lastdate, document.querySelector('.content'));
// });

// window.addEventListener('scroll', function(e){
//     // let tst = Math.ceil(window.innerHeight + window.pageYOffset);
//     if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
//         send_request(login, lastdate, document.querySelector('.content'));
//     }
// });

