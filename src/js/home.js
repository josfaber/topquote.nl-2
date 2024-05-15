const simpleslider = require( 'simple-slider' );
import * as Hammer from 'hammerjs';
window.Hammer = Hammer.default;

const normalize = ( value, minimum, maximum ) => { return ( value - minimum ) / ( maximum - minimum ); };
const interpolate = ( normValue, minimum, maximum ) => { return minimum + ( maximum - minimum ) * normValue; };
const map = ( value, min1, max1, min2, max2 ) => { return interpolate( normalize( value, min1, max1 ), min2, max2 ); };

/**
 * On document ready
 */
document.addEventListener( 'DOMContentLoaded', ( event ) => {
  console.log( 'home' );

  const sliderDelay = 7;
  const sliderDuration = 0.4;

  let saidLastWeekIsNext = true;
  const saidLastWeekSlider = simpleslider.getSlider( {
    container: document.getElementById( 'said-last-week' ),
    duration: sliderDuration,
    delay: sliderDelay,
    onChange: ( e ) => {
      console.log( 'onChange', e );
    }
  } );
  const saidLastWeekManager = new Hammer.Manager( document.getElementById( 'said-last-week' ) );
  const saidLastWeekSwipe = new Hammer.Swipe( { direction: Hammer.DIRECTION_HORIZONTAL } );
  saidLastWeekManager.add( saidLastWeekSwipe );
  saidLastWeekManager.on( 'swipeleft', () => {
    if ( saidLastWeekIsNext )
    {
      saidLastWeekSlider.reverse();
      saidLastWeekIsNext = false;
    }
    saidLastWeekSlider.next();
  } );
  saidLastWeekManager.on( 'swiperight', () => {
    if ( !saidLastWeekIsNext )
    {
      saidLastWeekSlider.reverse();
      saidLastWeekIsNext = true;
    }
    saidLastWeekSlider.next();
  } );



  let randomQuotesIsNext = true;
  const randomQuotesSlider = simpleslider.getSlider( {
    container: document.getElementById( 'random-quotes' ),
    duration: sliderDuration,
    delay: sliderDelay,
    onChange: ( e ) => {
      console.log( 'onChange', e );
    }
  } );
  const randomQuotesManager = new Hammer.Manager( document.getElementById( 'random-quotes' ) );
  const randomQuotesSwipe = new Hammer.Swipe( { direction: Hammer.DIRECTION_HORIZONTAL } );
  randomQuotesManager.add( randomQuotesSwipe );
  randomQuotesManager.on( 'swipeleft', () => {
    if ( randomQuotesIsNext )
    {
      randomQuotesSlider.reverse();
      randomQuotesIsNext = false;
    }
    randomQuotesSlider.next();
  } );
  randomQuotesManager.on( 'swiperight', () => {
    if ( !randomQuotesIsNext )
    {
      randomQuotesSlider.reverse();
      randomQuotesIsNext = true;
    }
    randomQuotesSlider.next();
  } );

  randomQuotesSlider.pause();
  setTimeout( () => randomQuotesSlider.resume(), 300 );

  // hide title on home no scroll 
  const title_bg_el = document.getElementById( 'home_title_bg' );
  const title_el = document.getElementById( 'home_title' );
  const root_font_size = parseFloat( window.getComputedStyle( document.documentElement ).fontSize );
  const title_el_margin = parseFloat( window.getComputedStyle( title_el ).marginTop );
  const max_title_size_rem = parseFloat( window.getComputedStyle( title_el ).fontSize ) / root_font_size;
  const topbar_height = parseFloat( window.getComputedStyle( document.getElementById( 'topbar' ) ).height );
  const travel_distance = topbar_height + title_el_margin + 13;
  // console.log(travel_distance);

  let fontSize = max_title_size_rem;
  window.onscroll = ( () => {
    let scrollPos = window.pageYOffset;
    // console.log(scrollPos);
    fontSize = map( Math.min( travel_distance, scrollPos ), 0, travel_distance, max_title_size_rem, 1.125 );
    title_bg_el.style.fontSize = `${ fontSize }rem`;
    title_el.style.fontSize = `${ fontSize }rem`;
    if ( scrollPos > 0.2 * travel_distance )
    {
      if ( scrollPos > travel_distance && !title_el.classList.contains( 'fixed' ) )
      {
        title_bg_el.classList.remove( 'fixed' );
        title_el.classList.add( 'fixed' );
      } else if ( scrollPos <= travel_distance && title_el.classList.contains( 'fixed' ) )
      {
        title_bg_el.classList.add( 'fixed' );
        title_el.classList.remove( 'fixed' );
      }
    }
  } );

  document.querySelectorAll( '.sliding-quotes' ).forEach( ( el ) => {
    el.classList.add( 'active' );
  } );

} );