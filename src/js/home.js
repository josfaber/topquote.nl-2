const simpleslider = require('simple-slider');
import * as Hammer from 'hammerjs';
window.Hammer = Hammer.default;

/**
 * On body ready
 */
document.body.onload = ( () => {
    
    console.log('home');

    const sliderDelay = 7;
    const sliderDuration = 0.4;

    let saidLastWeekIsNext = true;
    const saidLastWeekSlider = simpleslider.getSlider({
        container: document.getElementById('said-last-week'),
        duration: sliderDuration,
        delay: sliderDelay,
        onChange: (e) => {
            console.log('onChange', e);
        }
    });
    const saidLastWeekManager = new Hammer.Manager(document.getElementById('said-last-week'));
    const saidLastWeekSwipe = new Hammer.Swipe({direction: Hammer.DIRECTION_HORIZONTAL});
    saidLastWeekManager.add(saidLastWeekSwipe);
    saidLastWeekManager.on('swipeleft', () => {
      if (saidLastWeekIsNext) {
        saidLastWeekSlider.reverse();
        saidLastWeekIsNext = false;
      }
      saidLastWeekSlider.next();
    });
    saidLastWeekManager.on('swiperight', () => {
      if (!saidLastWeekIsNext) {
        saidLastWeekSlider.reverse();
        saidLastWeekIsNext = true;
      }
      saidLastWeekSlider.next();
    });



    let randomQuotesIsNext = true;
    const randomQuotesSlider = simpleslider.getSlider({
        container: document.getElementById('random-quotes'),
        duration: sliderDuration,
        delay: sliderDelay,
        onChange: (e) => {
            console.log('onChange', e);
        }
    });
    const randomQuotesManager = new Hammer.Manager(document.getElementById('random-quotes'));
    const randomQuotesSwipe = new Hammer.Swipe({direction: Hammer.DIRECTION_HORIZONTAL});
    randomQuotesManager.add(randomQuotesSwipe);
    randomQuotesManager.on('swipeleft', () => {
      if (randomQuotesIsNext) {
        randomQuotesSlider.reverse();
        randomQuotesIsNext = false;
      }
      randomQuotesSlider.next();
    });
    randomQuotesManager.on('swiperight', () => {
      if (!randomQuotesIsNext) {
        randomQuotesSlider.reverse();
        randomQuotesIsNext = true;
      }
      randomQuotesSlider.next();
    });

    randomQuotesSlider.pause();
    setTimeout(() => randomQuotesSlider.resume(), 300);


 });