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
let tqcnum = window.localStorage.getItem('topquote-color-num');
const transitionTimeoutTime = tqcnum ? 100 : 5;
if (!tqcnum) {
    tqcnum = 0;
    window.localStorage.setItem('topquote-color-num', tqcnum);
}
let color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');
document.documentElement.style.setProperty('--color-transition-time', '0ms');
setTimeout( () => updateColor(tqcnum), 20);
setTimeout( () => document.documentElement.style.setProperty('--color-transition-time', `${color_transition_time}`), transitionTimeoutTime);

const scaleDownQuote = (el, fontSizeRem = 3.6, minFontSizeRem = 1) => {
    if (!el) return;
    el.style.fontSize = `${fontSizeRem}rem`;
    const elHeight = el.offsetHeight;
    const winHeight = window.innerHeight;
    if (elHeight > minFontSizeRem && elHeight > 0.8 * winHeight) scaleDownQuote(el, fontSizeRem - 0.1, minFontSizeRem);
};

const normalize = (value, minimum, maximum) => { return (value - minimum) / (maximum - minimum); }
const interpolate = (normValue, minimum, maximum) => { return minimum + (maximum - minimum) * normValue; }    
const map = (value, min1, max1, min2, max2) => { return interpolate( normalize(value, min1, max1), min2, max2); } 

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

    // handle add form 
    const addForm = document.getElementById('addForm');
    if (addForm) {
        addForm.addEventListener('submit', (e) => {
            e.preventDefault();
            grecaptcha.ready(function() {
              grecaptcha.execute(window.tqd.rsk, {action: 'submit'}).then((token) => {
                  document.getElementById('rtoken').value = token;
                  e.target.submit();
              });
            });
        });
    }

    // single quote
    if (document.body.classList.contains("single-quote")) {
        scaleDownQuote(document.querySelector('blockquote .quote'));
    }
    // hide title on home no scroll 
    if (document.body.classList.contains("home")) {
        
        const title_bg_el = document.getElementById('home_title_bg');
        const title_el = document.getElementById('home_title');
        const root_font_size = parseFloat(window.getComputedStyle(document.documentElement).fontSize);
        const title_el_margin = parseFloat(window.getComputedStyle(title_el).marginTop);
        const max_title_size_rem = parseFloat(window.getComputedStyle(title_el).fontSize) / root_font_size;
        const topbar_height = parseFloat(window.getComputedStyle(document.getElementById('topbar')).height);
        const travel_distance = topbar_height + title_el_margin + 13;
        console.log(travel_distance);
        
        let fontSize = max_title_size_rem;
        window.onscroll = ( () => {
            let scrollPos = window.pageYOffset;
            // console.log(scrollPos);
            fontSize = map(Math.min(travel_distance, scrollPos), 0, travel_distance, max_title_size_rem, 1.125);
            title_bg_el.style.fontSize = `${fontSize}rem`;
            title_el.style.fontSize = `${fontSize}rem`;
            if (scrollPos > 0.2 * travel_distance) {
                if (scrollPos > travel_distance && !title_el.classList.contains('fixed')) {
                    title_bg_el.classList.remove('fixed');
                    title_el.classList.add('fixed');
                } else if (scrollPos <= travel_distance && title_el.classList.contains('fixed')) {
                    title_bg_el.classList.add('fixed');
                    title_el.classList.remove('fixed');
                }
            }
        } );
    }

} )();
