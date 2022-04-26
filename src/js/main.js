import '../scss/styles.scss';

const updateColor = (c) => {
    // set doc's primary color
    let altClr = getComputedStyle(document.documentElement).getPropertyValue(`--alt-color-${c}`);
    document.documentElement.style.setProperty('--primary-color', altClr);
    // update active 
    const el_active = document.querySelector('.clr.active')
    !el_active || el_active.classList.remove('active');
    const el_new = document.querySelector(`.clr[data-c="${c}"]`);
    !el_new || el_new.classList.add('active');
}

// update color 
const tqcnum = window.localStorage.getItem('topquote-color-num');
if (tqcnum) {
    
    let color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');
    document.documentElement.style.setProperty('--color-transition-time', '0ms');
    setTimeout( () => updateColor(tqcnum), 20);
    setTimeout( () => document.documentElement.style.setProperty('--color-transition-time', `${color_transition_time}`), 40);
}

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

    // onchange clr 
    document.querySelectorAll('.clr').forEach( (el) => el.addEventListener("click", (e) => {
        e.preventDefault();
        let c = el.dataset.c;
        !c || updateColor(c);
        // update storage 
        window.localStorage.setItem('topquote-color-num', c);
    }));

} )();
