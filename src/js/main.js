const axios = require( 'axios' ).default;

import '../scss/styles.scss';

import Cookies from 'js-cookie';

import copy from 'copy-to-clipboard';

let main_el,
    menucb,
    addForm,
    feedbackForm,
    btn_delete,
    btn_search;

const updateColor = ( c ) => {
    // set doc's primary color
    let altClr = getComputedStyle( document.documentElement ).getPropertyValue( `--alt-color-${ c }` );
    document.documentElement.style.setProperty( '--primary-color', altClr );
    document.documentElement.style.setProperty( '--primary-color-bg', c < 6 ? '#000' : '#f4f4f4' );
    document.documentElement.style.setProperty( '--primary-color-wh', c < 6 ? '#fff' : '#333' );
    // update active 
    const el_active = document.querySelector( '.clr.active' );
    !el_active || el_active.classList.remove( 'active' );
    const el_new = document.querySelector( `.clr[data-c="${ c }"]` );
    !el_new || el_new.classList.add( 'active' );
};

// update color 
let tqcnum = window.localStorage.getItem( 'topquote-color-num' );
const transitionTimeoutTime = tqcnum ? 100 : 5;
if ( !tqcnum )
{
    tqcnum = 0;
    window.localStorage.setItem( 'topquote-color-num', tqcnum );
}
let color_transition_time = getComputedStyle( document.documentElement ).getPropertyValue( '--color-transition-time' );
document.documentElement.style.setProperty( '--color-transition-time', '0ms' );
setTimeout( () => updateColor( tqcnum ), 20 );
setTimeout( () => document.documentElement.style.setProperty( '--color-transition-time', `${ color_transition_time }` ), transitionTimeoutTime );

const scaleDownQuote = ( el, fontSizeRem = 3.6, minFontSizeRem = 1 ) => {
    if ( !el ) return;
    el.style.fontSize = `${ fontSizeRem }rem`;
    const elHeight = el.offsetHeight;
    const winHeight = window.innerHeight;
    if ( elHeight > minFontSizeRem && elHeight > 0.8 * winHeight ) scaleDownQuote( el, fontSizeRem - 0.1, minFontSizeRem );
};

const copyUrl = () => {
    copy( document.getElementById( 'share-url' ).innerText );
    bodyClickHandler();
};

const tweetUrl = () => {
    window.open( `https://twitter.com/intent/tweet?text=${ encodeURIComponent( document.getElementById( 'share-url' ).innerText ) }`, '_blank' );
    bodyClickHandler();
};

const mailUrl = () => {
    window.location.href = `mailto:?subject=${ encodeURIComponent( 'Check deze quote' ) }&body=${ encodeURIComponent( document.getElementById( 'share-url' ).innerText ) }`;
    bodyClickHandler();
};

const likeQuote = ( id ) => {
    id = parseInt( id );
    // get cookie 
    // const likes_array = (Cookies.get( `tql` ) || "")
    const likes_array = ( window.localStorage.getItem( 'topquote-likes' ) || "" )
        .split( ',' )
        .filter( ( x ) => x !== "" )
        .map( ( x ) => parseInt( x ) );
    // console.log( likes_array, id, likes_array.includes( id ) );

    // const quote_like_cookie = Cookies.get( `tql${id}` );
    // if (!quote_like_cookie) {
    if ( !likes_array.includes( id ) )
    {
        const anim = document.getElementById( `q${ id }-anim` );
        !anim || anim.classList.add( 'active' );

        let data = new URLSearchParams();
        data.append( 'id', id );

        axios( {
            method: 'post',
            url: window.tqd.api_url + '/vote',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            data,
        } )
            .then( function ( response ) {
                // console.log( response.data );
                const message = response.data.message || false;
                console.log( 'message', message );
                if ( message && message === 'voted' )
                {
                    const quote_id = response.data.quote_id || false;
                    const likes = response.data.likes || false;
                    console.log( quote_id, likes );
                    if ( quote_id && likes !== false )
                    {
                        const likes_el = document.getElementById( `q${ quote_id }-likes` );
                        console.log( `q${ quote_id }-likes`, likes_el );
                        if ( likes_el ) likes_el.innerText = likes;
                    }
                }
                likes_array.push( id );
                // Cookies.set( `tql`, likes_array.join(','), { expires: 365 * 10 } );
                window.localStorage.setItem( 'topquote-likes', likes_array.join( ',' ) );
            } )
            .catch( function ( error ) {
                // handle error
                console.log( error );
            } );
    }
};

const shareQuote = ( url ) => {
    !main_el || main_el.classList.add( 'blur' );

    const share_url_el = document.getElementById( 'share-url' );
    share_url_el.innerText = url;

    const share_container = document.getElementById( 'share-container' );
    !share_container || share_container.classList.add( 'active' );

    const btn_copy = document.getElementById( 'btnCopy' );
    !btn_copy || btn_copy.addEventListener( 'click', copyUrl );
    const btn_tweet = document.getElementById( 'btnTweet' );
    !btn_tweet || btn_tweet.addEventListener( 'click', tweetUrl );
    const btn_mail = document.getElementById( 'btnMail' );
    !btn_mail || btn_mail.addEventListener( 'click', mailUrl );

    // console.log(main_el, share_container.classList, share_url_el);
    !main_el || setTimeout( () => main_el.addEventListener( 'click', bodyClickHandler ), 100 );
};

const bodyClickHandler = ( e ) => {
    !main_el || main_el.removeEventListener( 'click', bodyClickHandler );
    !main_el || main_el.classList.remove( 'blur' );

    menucb.checked = false;

    const btn_copy = document.getElementById( 'btnCopy' );
    !btn_copy || btn_copy.removeEventListener( 'click', copyUrl );
    const btn_tweet = document.getElementById( 'btnTweet' );
    !btn_tweet || btn_tweet.removeEventListener( 'click', tweetUrl );
    const btn_mail = document.getElementById( 'btnMail' );
    !btn_mail || btn_mail.removeEventListener( 'click', mailUrl );

    const share_container = document.getElementById( 'share-container' );
    !share_container || share_container.classList.remove( 'active' );
};

const showLoader = () => {
    !main_el || main_el.classList.add( 'blur' );
    const loader_el = document.getElementById( 'loader-container' );
    console.log( "#", loader_el );
    !loader_el || loader_el.classList.add( 'active' );
};

window.updateLikeButtons = () => {
    const likes_array = ( window.localStorage.getItem( 'topquote-likes' ) || "" )
        .split( ',' )
        .filter( ( x ) => x !== "" )
        .map( ( x ) => parseInt( x ) );
    console.log( likes_array );
    const like_buttons = document.querySelectorAll( '.quote-btn-like' );
    like_buttons.forEach( ( el ) => {
        const id = parseInt( el.dataset.id );
        if ( likes_array.includes( id ) )
        {
            el.classList.add( 'priclr' );
            el.parentElement.querySelector( '.anim > .heart > .icon' ).classList.add( 'priclr' );
        }
    } );
};

window.activateLikeButtons = () => {
    console.log('activate like buttons')
    const like_buttons = document.querySelectorAll( '.quote-btn-like' );
    like_buttons.forEach( ( el ) => {
        el.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            el.classList.add( 'priclr' );
            el.parentElement.querySelector( '.anim > .heart > .icon' ).classList.add( 'priclr' );
            likeQuote( e.target.dataset.id );
        } );
    } );
};

/**
 * On body ready
 */
document.body.onload = ( () => {

    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push( arguments ); }
    gtag( 'js', new Date() );
    gtag( 'config', 'G-6YFKGSMEFN' );

    main_el = document.getElementsByTagName( 'main' )[ 0 ];
    menucb = document.getElementById( 'menucb' );

    // share 
    const share_buttons = document.querySelectorAll( '.quote-btn-share' );
    share_buttons.forEach( ( el ) => {
        el.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            shareQuote( e.target.dataset.url );
        } );
    } );

    // like 
    // const like_buttons = document.querySelectorAll( '.quote-btn-like' );
    // like_buttons.forEach( ( el ) => {
    //     el.addEventListener( 'click', ( e ) => {
    //         e.preventDefault();
    //         el.classList.add( 'priclr' );
    //         el.parentElement.querySelector( '.anim > .heart > .icon' ).classList.add( 'priclr' );
    //         likeQuote( e.target.dataset.id );
    //     } );
    // } );

    // onchange menucb
    menucb.onchange = ( () => setTimeout( () => {
        if ( menucb.checked )
        {
            !main_el || main_el.classList.add( 'blur' );
            !main_el || setTimeout( () => main_el.addEventListener( 'click', bodyClickHandler ), 100 );

        } else
        {
            !main_el || main_el.classList.remove( 'blur' );
            !main_el || main_el.removeEventListener( 'click', bodyClickHandler );
        }
    }, 50 ) );

    // onchange clr 
    document.querySelectorAll( '.clr' ).forEach( ( el ) => el.addEventListener( "click", ( e ) => {
        e.preventDefault();
        let c = el.dataset.c;
        !c || updateColor( c );
        // update storage 
        window.localStorage.setItem( 'topquote-color-num', c );
    } ) );

    // if in large mode, check for sayer height 
    // console.log(window.innerWidth);
    if ( window.innerWidth >= 1024 )
    {
        // for every blockquote 
        document.querySelectorAll( 'blockquote' ).forEach( ( el ) => {
            let sayer_el = el.querySelector( '.sayer' );
            let meta_el = el.querySelector( '.meta' );
            if ( !sayer_el || !meta_el ) return;
            let sayer_top = sayer_el.getBoundingClientRect().top;
            let sayer_height = sayer_el.offsetHeight;
            meta_el.style.top = `${ 4 + sayer_height }px`;
        } );
    }

    // handle feedback form 
    feedbackForm = document.getElementById( 'feedbackForm' );
    if ( feedbackForm )
    {
        const f_email = document.getElementById( 'f_email' );
        !f_email || ( f_email.value = Cookies.get( 'tqeml' ) || "" );
        const f_from = document.getElementById( 'f_from' );
        !f_from || ( f_from.value = Cookies.get( 'tqfrm' ) || "" );

        feedbackForm.addEventListener( 'submit', ( e ) => {
            e.preventDefault();
            grecaptcha.ready( function () {
                grecaptcha.execute( window.tqd.rsk, { action: 'submit' } ).then( ( token ) => {
                    document.getElementById( 'rtoken' ).value = token;
                    if ( f_email ) Cookies.set( 'tqeml', f_email.value, { expires: 365 } );
                    if ( f_from ) Cookies.set( 'tqfrm', f_from.value, { expires: 365 } );
                    showLoader();
                    e.target.submit();
                } );
            } );
        } );
    }

    // handle add form 
    addForm = document.getElementById( 'addForm' );
    if ( addForm )
    {
        const f_email = document.getElementById( 'f_email' );
        !f_email || ( f_email.value = Cookies.get( 'tqeml' ) || "" );
        const f_from = document.getElementById( 'f_from' );
        !f_from || ( f_from.value = Cookies.get( 'tqfrm' ) || "" );
        addForm.addEventListener( 'submit', ( e ) => {
            e.preventDefault();
            grecaptcha.ready( function () {
                grecaptcha.execute( window.tqd.rsk, { action: 'submit' } ).then( ( token ) => {
                    document.getElementById( 'rtoken' ).value = token;
                    if ( f_email ) Cookies.set( 'tqeml', f_email.value, { expires: 365 } );
                    if ( f_from ) Cookies.set( 'tqfrm', f_from.value, { expires: 365 } );
                    showLoader();
                    e.target.submit();
                } );
            } );
        } );
    }

    // handle delete on editForm
    btn_delete = document.getElementById( 'btnDelete' );
    if ( btn_delete )
    {
        btn_delete.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            if ( confirm( "Weet je zeker dat je de quote wilt verwijderen?" ) )
            {
                document.getElementById( 'f_is_delete' ).value = 1;
                document.getElementById( 'editForm' ).submit();
            }
        } );
    }

    // search 
    btn_search = document.getElementById( 'btnSearch' );
    btn_search.addEventListener( 'click', ( e ) => {
        e.preventDefault();
        const terms_container = document.getElementById( 'terms-container' );
        const terms_input = document.getElementById( 'terms' );
        const keyHandler = ( e ) => {
            console.log( e.keyCode );
            if ( e.keyCode === 13 )
            { // enter
                const terms = document.getElementById( 'terms' );
                !terms || ( window.location.href = tqd.site_url + '/quotes/search/' + encodeURIComponent( terms.value ) );
            } else if ( e.keyCode === 27 )
            { // esc
                terms_input.value = '';
                terms_input.removeEventListener( 'keyup', keyHandler );
                terms_container.classList.remove( 'active' );
            }
        };
        if ( !terms_container.classList.contains( 'active' ) )
        {
            terms_container.classList.add( 'active' );
            terms_input.addEventListener( 'keyup', keyHandler );
            terms_input.focus();
        } else
        {
            terms_container.classList.remove( 'active' );
            terms_input.removeEventListener( 'keyup', keyHandler );
            terms_input.value = '';
        }
    } );

    // single quote
    if ( document.body.classList.contains( "single-quote" ) )
    {
        scaleDownQuote( document.querySelector( 'blockquote .quote h1' ) );
    }

    activateLikeButtons();

    updateLikeButtons();

} )();
