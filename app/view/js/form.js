function        togglePasswd(target, elem){
        elem.classList.toggle('fa-eye');
    elem.classList.toggle('fa-eye-slash');
    if (elem.className.search('fa-eye-slash') !== -1 ){
        target.type = 'password';
    }
    else
        target.type = 'text';
}
