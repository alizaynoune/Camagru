document.querySelector('input[name="fack_submit"]').addEventListener('click', (e) =>{
    var contener = document.querySelector('form');
    if (!contener.querySelector('.alt') && !validationAll(contener)){
        var alt = document.createElement('div');
            alt.classList.add('alt');
            contener.appendChild(alt);
        
        var msj = document.createElement('p');
            msj.innerHTML = 'are you sure to delete this account'
            alt.appendChild(msj);
        
        var labelYes = document.createElement('label');
            labelYes.setAttribute('for', 'yes_delet');
            labelYes.classList.add('Btn');
            labelYes.innerHTML = 'YES';
            alt.appendChild(labelYes);
        
        var no = document.createElement('button');
            no.classList.add('BtnAnim');
            no.setAttribute('id', 'no_delete');
            no.addEventListener('click', function(){
                alt.remove();
                return false;
            }, true);
            alt.appendChild(no);
        
        
        var labelNo = document.createElement('label');
            labelNo.setAttribute('for', 'no_delete');
            labelNo.classList.add('Btn');
            labelNo.innerHTML = 'NO';
            alt.appendChild(labelNo);
    }
});

document.querySelector('form').addEventListener('keyup', (e)=>{
    if (e.keyCode === 13){
        document.querySelector('input[name="fack_submit"]').click();
    }
});


