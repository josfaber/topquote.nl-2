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
    
    const bodyClickHandler = (e) => {
        !main_el || main_el.removeEventListener('click', bodyClickHandler);
        !main_el || main_el.classList.remove('blur');
        menucb.checked = false;
    }

    // onchange menucb
    menucb.onchange = ( () => setTimeout(() => {
        if (menucb.checked) {
            !main_el || main_el.classList.add('blur');
            !main_el || main_el.addEventListener('click', bodyClickHandler);
        } else {
            !main_el || main_el.classList.remove('blur');
            !main_el || main_el.removeEventListener('click', bodyClickHandler);
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

    // if in large mode, check for sayer height 
    // console.log(window.innerWidth);
    if (window.innerWidth >= 1024) {
        // for every blockquote 
        document.querySelectorAll('blockquote').forEach( (el) => {
            let sayer_el = el.querySelector('.sayer');
            let meta_el = el.querySelector('.meta');
            if (!sayer_el || !meta_el) return;
            let sayer_top = sayer_el.getBoundingClientRect().top;
            let sayer_height = sayer_el.offsetHeight;
            meta_el.style.top = `${4 + sayer_height}px`;
        });
    }

} )();
