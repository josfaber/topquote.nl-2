const axios = require( 'axios' ).default;

let current_page = window.tqd.p;

let canLoadMore = true;

const loadMore = () => {

    let data = new URLSearchParams();
    data.append( 'ob', window.tqd.ob );
    data.append( 'o', window.tqd.o );
    data.append( 'p', current_page + 1 );
    data.append( 'render', true );

    axios( {
        method: 'post',
        url: window.tqd.api_url + '/quotes',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        data,
    } )
        .then( function ( response ) {
            // handle success
            console.log( response.data );
            document.getElementById('quotes_list').innerHTML += response.data.html;
            current_page++;
            setTimeout(() => canLoadMore = true, 500);
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

    setTimeout(() => {
        window.addEventListener( 'scroll', () => {
            if ( canLoadMore && window.scrollY + window.innerHeight >= document.body.offsetHeight - 400 ) {
                canLoadMore = false;
                loadMore();
            }
        } );

    }, 1000)
} )();
