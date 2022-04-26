import '../scss/styles.scss';

/**
 * On body ready
 */
document.body.onload = ( () => {

    const menucb = document.getElementById('menucb');
    const main_el = document.getElementsByTagName('main')[0];

    // onchange menucb
    menucb.onchange = ( () => setTimeout(() => {
        if (menucb.checked) {
            !main_el || main_el.classList.add('blur');
        } else {
            !main_el || main_el.classList.remove('blur');
        }
    }, 50) );

} )();
