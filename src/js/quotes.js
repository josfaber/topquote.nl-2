const axios = require( 'axios' ).default;

let current_page = window.tqd.page;

let canLoadMore = true;

const loadMore = () => {

    let data = new URLSearchParams();
    data.append( 'orderby', window.tqd.orderby );
    data.append( 'order', window.tqd.order );
    data.append( 'page', current_page + 1 );
    data.append( 'render', true );

    if (window.tqd.hasOwnProperty('filter')) data.append( 'filter', window.tqd.filter );
    if (window.tqd.hasOwnProperty('slug')) data.append( 'slug', window.tqd.slug );

    axios( {
        method: 'post',
        url: window.tqd.api_url + '/quotes',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        data,
    } )
        .then( function ( response ) {
            // handle success
            // console.log( response.data );
            current_page++;

            if (!response.data.hasOwnProperty('EOD') || response.data.EOD != true) {
                setTimeout(() => canLoadMore = true, 500);
                "undefined" === typeof activateLikeButtons || activateLikeButtons();
                "undefined" === typeof updateLikeButtons || updateLikeButtons();
            }
        } )
        .catch( function ( error ) {
            // handle error
            console.log( error );
        } );
    // .then( function () {
    //     // always executed
    // } );
};

/**
 * On body ready
 */
document.body.onload = ( () => {

    window.tqd.is_search || setTimeout(() => {
        window.addEventListener( 'scroll', () => {
            if ( canLoadMore && window.scrollY + window.innerHeight >= document.body.offsetHeight - 400 ) {
                canLoadMore = false;
                loadMore();
            }
        } );

    }, 1000)
} )();
