const axios = require( 'axios' ).default;

let current_page = window.tqd.page;

let canLoadMore = true;

const loadMore = () => {

    const data = new URLSearchParams();
    data.append( 'orderby', window.tqd.orderby );
    data.append( 'order', window.tqd.order );
    data.append( 'page', current_page + 1 );
    data.append( 'render', true );

    if ( Object.prototype.hasOwnProperty.call( window.tqd, 'filter' ) ) data.append( 'filter', window.tqd.filter );
    if ( Object.prototype.hasOwnProperty.call( window.tqd, 'slug' ) ) data.append( 'slug', window.tqd.slug );

    console.log( `${ window.tqd.api_url }/quotes`, data );

    axios( {
        method: 'post',
        url: `${ window.tqd.api_url }/quotes`,
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        data,
    } )
        .then( ( response ) => {
            // handle success
            // console.log( response.data );
            const quotes_list = document.getElementById( 'quotes_list' );
            if ( quotes_list )
            {
                quotes_list.innerHTML += response.data.html || "";
                loadMoreAdSenseAd();
            }
            current_page++;

            if ( !Object.prototype.hasOwnProperty.call( response.data, 'EOD' ) || response.data.EOD !== true )
            {
                setTimeout(() => {
                    canLoadMore = true;
                }, 500);
                if (typeof activateLikeButtons !== "undefined") activateLikeButtons();
                if (typeof updateLikeButtons !== "undefined") updateLikeButtons();
            }
        } )
        .catch( ( error ) => {
            // handle error
            console.log( error );
        } );
    // .then( function () {
    //     // always executed
    // } );
};

const loadMoreAdSenseAd = () => {
    const quotes_list = document.getElementById( 'quotes_list' );
    const ad = document.createElement('ins');
    ad.className = 'adsbygoogle';
    ad.style.display = 'block';
    ad.style.textAlign = 'center';
    ad.setAttribute( 'data-ad-client', 'ca-pub-2356098750828124' );
    ad.setAttribute( 'data-ad-slot', '7032630758' );
    ad.setAttribute( 'data-ad-format', 'fluid' );
    ad.setAttribute( 'data-ad-layout', 'in-article' );
    quotes_list.appendChild( ad );
    window.adsbygoogle = window.adsbygoogle || [];
    window.adsbygoogle.push( {} );
}

/**
 * On document ready
 */
document.addEventListener( 'DOMContentLoaded', ( event ) => {
    window.tqd.is_search || setTimeout( () => {
        window.addEventListener( 'scroll', () => {
            if ( canLoadMore && window.scrollY + window.innerHeight >= document.body.offsetHeight - 400 )
            {
                canLoadMore = false;
                loadMore();
            }
        } );

    }, 1000 );
} );
