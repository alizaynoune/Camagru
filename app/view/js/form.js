function        togglePasswd(elem){
    var prev = elem.previousElementSibling;
    elem.classList.toggle('fa-eye');
    elem.classList.toggle('fa-eye-slash');
    if (elem.className === 'fa fa-eye'){
        prev.type = 'text';
    }
    else
        prev.type = 'password';
}