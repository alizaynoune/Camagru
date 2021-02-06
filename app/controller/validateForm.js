/* all Valdition Inputs*/

function        validationPasswd(Input){
    let Ret = 0;
    let RExp1 = /^.*[a-z].*$/;
    let RExp2 = /^.*[A-Z].*$/;
    let RExp3 = /^.*[0-9].*$/;
    let RExp4 = /^.*[~!@#$%^&*()\_\-\+=\\\.\?<>,\[\]\{\}:'";/].*$/;
    if (Input.value.length < 8)
        Ret++;
    if (!RExp1.test(Input.value))
        Ret++;
    if (!RExp2.test(Input.value))
        Ret++;
    if (!RExp3.test(Input.value))
        Ret++;
    if (!RExp4.test(Input.value))
        Ret++;
    if (Input.value.length > 20)
        Ret = 5;
    return (Ret);
}

function        validationConfPasswd(Input, passwd){
    if (Input.value !== passwd.value)
        return(1);
    else
        return(0);
}

function        validationNewPasswd(Input, old){
    if (validationPasswd(Input) || !validationConfPasswd(Input, old))
        return(1);
    else
        return(0);
}

function        validationEmail(Input){
    let RExp = /^[a-zA-Z0-9]+([\w-\+\!\#\$\%\&\'\*\=\?\^\`\{\|]+[\.]{0,1})+[a-zA-Z0-9]+@([a-z0-9]{1})+(\.{0,1}[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if (!RExp.test(Input.value) || Input.value.length > 50)
        return(1);
    else
        return(0);
}



function        validationLogin(Input){
    let RExp = /^[\w-]+$/;
    if (!RExp.test(Input.value) || Input.value.length > 20 || Input.value.length < 8)
        return(1);
    else
        return(0);
}

function        validationName(Input){
    let RExp = /^[a-zA-Z]+$/;
    if (!RExp.test(Input.value) || Input.value.length > 20 || Input.value.length < 3)
        return(1);
    else
        return(0);
}

/* all Event Inputs */

function        eventName(Input){
    Input.addEventListener('input', (e)=>{
    if (validationName(Input))
        Input.classList.add('error');
     else
        Input.classList.remove('error');
    });
}

function        eventLogin(Input){
    Input.addEventListener('input', (e)=>{
        if (validationLogin(Input))
            Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}

function        eventEmail(Input){
    Input.addEventListener('input', (e)=>{
        if (validationEmail(Input))
            Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}

function        eventPasswd(Input){
    Input.addEventListener('input', (e)=>{
        let Pass = validationPasswd(Input);

        if (Pass === 0){
            Input.classList.remove('error');
            Input.classList.remove('PasswdMed');
            Input.classList.add('PasswdGood');
        }
        else if ( Pass <= 2){
            Input.classList.remove('error');
            Input.classList.add('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
        else{
            Input.classList.add('error');
            Input.classList.remove('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
    });
}

function        eventnewPasswd(Input, oldPass){
    Input.addEventListener('input', (e)=>{
        let Pass = validationPasswd(Input);
        if (!validationConfPasswd(Input, oldPass))
            Pass = 3;

        if (Pass === 0 ){
            Input.classList.remove('error');
            Input.classList.remove('PasswdMed');
            Input.classList.add('PasswdGood');
        }
        else if ( Pass <= 2){
            Input.classList.remove('error');
            Input.classList.add('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
        else{
            Input.classList.add('error');
            Input.classList.remove('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
    });
}

function        eventConfPasswd(Input, passwd){
    Input.addEventListener('input', (e)=>{
        if (validationConfPasswd(Input, passwd))
        Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}

function        eventconfnewPasswd(Input, confPass){
    eventConfPasswd(Input, confPass);
}

function        eventUserName(Input, passwd){
    Input.addEventListener('input', (e)=>{
        if (validationUserName(Input, passwd))
        Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}

function        ifUpdateInfo(){
    if(form.querySelector('input[name="oldPasswd"]').value.length > 0
            || form.querySelector('input[name="newPasswd"]').value.length > 0
            || form.querySelector('input[name="confnewPasswd"]').value.length > 0)
        return(true);
    
    return(false);
}

function    validationImage(img){
    console.log(img);
    return(0); ///////////////////////not fineshed yet
}

const form = document.querySelector('form');
const inputs = form.querySelectorAll('input');
for (var i = 0; i < inputs.length; i++){
    if (inputs[i].name === 'login')
        eventLogin(inputs[i]);
    else if (inputs[i].name === 'firstName' || inputs[i].name === 'lastName')
        eventName(inputs[i]);
    else if (inputs[i].name === 'confPasswd')
        eventConfPasswd(inputs[i], form.querySelector('input[name="passwd"]'));
    else if (inputs[i].name === 'passwd' || inputs[i].name === 'oldPasswd')
        eventPasswd(inputs[i]);
    else if (inputs[i].name === 'newPasswd')
        eventnewPasswd(inputs[i], form.querySelector('input[name="oldPasswd"]'));
    else if (inputs[i].name === 'confnewPasswd')
        eventconfnewPasswd(inputs[i], form.querySelector('input[name="newPasswd"]'));
    else if (inputs[i].type === 'email')
        eventEmail(inputs[i]);
}

function        validationAll(form){
const inputs = form.querySelectorAll('input');
var Ret = 0;
// console.log(inputs);
for (var i = 0; i < inputs.length; i++){
    if (inputs[i].name === 'login')
        Ret = validationLogin(inputs[i]);
    else if (inputs[i].name === 'firstName' || inputs[i].name === 'lastName')
        Ret = validationName(inputs[i]);
    else if (inputs[i].name === 'confPasswd')
        Ret = validationConfPasswd(inputs[i], form.querySelector('input[name="passwd"]'));
    else if (inputs[i].name === 'passwd' || (inputs[i].name === 'oldPasswd' && ifUpdateInfo() === true))
        Ret = validationPasswd(inputs[i]);
    else if (inputs[i].type === 'email')
        Ret = validationEmail(inputs[i]);
    else if (inputs[i].name === 'newPasswd' && ifUpdateInfo() === true)
        Ret = validationNewPasswd(inputs[i], form.querySelector('input[name="oldPasswd"]'));
    else if (inputs[i].name === 'confnewPasswd' && ifUpdateInfo() === true)
        Ret = validationConfPasswd(inputs[i], form.querySelector('input[name="newPasswd"]'));
    else if (inputs[i].name === 'img_user')
        Ret = validationImage(inputs[i]);
    if (Ret > 0)
        return(1);
}
return (0);
}

document.querySelector('form').addEventListener('submit', (e) =>{
    const form = document.querySelector('form');
    if (validationAll(form))
        e.preventDefault();
    return false;
});


