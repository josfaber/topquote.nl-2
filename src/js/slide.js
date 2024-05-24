/**
 * On document ready
 */
document.addEventListener( 'DOMContentLoaded', ( event ) => {
    // console.log( 'slide' );

    if ( !window.tqd_sl_q || !window.tqd_sl_q.length ) {
        return;
    }

    // randomize
    for (let i = 0; i < 5; i++) {
        window.tqd_sl_q = window.tqd_sl_q.sort( () => Math.random() - 0.5 );
    } 

    const slide_el = document.getElementById( 'slide' );
    const quote_el = document.getElementById( 'quote' );
    const sayer_el = document.getElementById( 'sayer' );

    let timeout,
        current = -1,
        delay = 7;

    const get_quote = () => {
        if (++current >= window.tqd_sl_q.length) {
            current = 0;
            window.location.reload();
        }
        return window.tqd_sl_q[ current ];
    }

    const slideOut = () => {
        // console.log( 'slideOut', slide_el);
        slide_el.style.transition = `opacity 500ms ease-in, transform 500ms ease-in`;
        setTimeout( () => {
            slide_el.style.opacity = 0;
            slide_el.style.transform = 'translateX(-50px)';
        }, 20 );
    };

    const slideIn = () => {
        // console.log( 'slideIn', slide_el);
        slide_el.style.transition = `opacity 1s ease-out, transform 1s ease-out`;
        setTimeout( () => {
            slide_el.style.opacity = 1;
            slide_el.style.transform = 'translateX(0)';
        }, 20 );
    }

    const slide = () => {
        const quote = get_quote();

        // 0s
        slideOut();
        
        // 500ms
        setTimeout( () => {
            slide_el.style.transition = '';
        }, 530);

        setTimeout( () => {
            quote_el.innerHTML = quote.quote;
            quote_el.href = quote.link;
            sayer_el.innerHTML = quote.sayer;
            sayer_el.href = quote.sayer_link;
            slide_el.style.transform = 'translateX(50px)';
        }, 550);

        // 1s
        setTimeout( slideIn, 570 );

        timeout = setTimeout( slide, (delay + 2) * 1000 );
    }   

    slide();

} );