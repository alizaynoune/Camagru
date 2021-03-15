document.querySelector('input[name="fack_submit"]').addEventListener('click', (e) =>{
    // console.log(e);
    // e.preventDefault();
    // console.log(e);

    

    let contener = document.querySelector('form');
    if (!contener.querySelector('.alt') && !validationAll(contener)){
        let alt = document.createElement('div');
            alt.classList.add('alt');
            contener.appendChild(alt);
        
        let msj = document.createElement('p');
            msj.innerHTML = 'are you sure to delete this account'
            alt.appendChild(msj);
        
        let labelYes = document.createElement('label');
            labelYes.setAttribute('for', 'yes_delet');
            labelYes.classList.add('Btn');
            labelYes.innerHTML = 'YES';
            alt.appendChild(labelYes);
        
        let no = document.createElement('button');
            no.classList.add('BtnAnim');
            no.setAttribute('id', 'no_delete');
            no.addEventListener('click', function(){
                alt.remove();
                return false;
            }, true);
            alt.appendChild(no);
        
        
        let labelNo = document.createElement('label');
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


