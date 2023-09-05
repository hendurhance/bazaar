const CountDownTimer = (classnames, type) => {
    const els = document.getElementsByClassName(classnames);
    for (let i = 0; i < els.length; i++) {
        const el = els[i];
        const end_at = el.innerText;
        const time = CountDown(end_at);
            if(type == 'classic'){
                el.innerHTML = `<span id="${type}_days${i}">${time.days}</span>D :<span id="${type}_hours${i}">${time.hours}</span>H : <span id="${type}_minutes${i}">${time.minutes}</span>M : <span id="${type}_seconds${i}">${time.seconds}</span>S`;
            }else if(type == 'slider'){
                el.innerHTML = `
                <div class="countdown-single">
                    <h5 id="${type}_days${i}">${time.days}</h5>
                    <span>Days</span>
                </div>
                <div class="countdown-single">
                    <h5 id="${type}_hours${i}">${time.hours}</h5>
                    <span>Hours</span>
                </div>
                <div class="countdown-single">
                    <h5 id="${type}_minutes${i}">${time.minutes}</h5>
                    <span>Minutes</span>
                </div>
                <div class="countdown-single">
                    <h5 id="${type}_seconds${i}">${time.seconds}</h5>
                    <span>Seconds</span>
                </div>
            `;
            } else {
                el.innerHTML = `<span id="${type}_days${i}">${time.days}</span>D :<span id="${type}_hours${i}">${time.hours}</span>H : <span id="${type}_minutes${i}">${time.minutes}</span>M : <span id="${type}_seconds${i}">${time.seconds}</span>S`;
            }
        setInterval((index) => {
            const time = CountDown(end_at);
            document.getElementById(`${type}_days${index}`).innerHTML = time.days;
            document.getElementById(`${type}_hours${index}`).innerHTML = time.hours;
            document.getElementById(`${type}_minutes${index}`).innerHTML = time.minutes;
            document.getElementById(`${type}_seconds${index}`).innerHTML = time.seconds;
        }, 1000, i); // Pass the current index as an argument
    }
}

const CountDown = (end_at) => {
    const currentTime = new Date().getTime();
    const endTime = new Date(end_at).getTime();
    const distance = endTime - currentTime;
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    return {
        days: days,
        hours: hours,
        minutes: minutes,
        seconds: seconds
    };
}

CountDownTimer('countdown-classic', 'classic');
CountDownTimer('countdown-slider', 'slider');
CountDownTimer('countdown-default', 'default');




// Use the Countdown function on id="countdown1" element, the text is the end date
// so remove the text and update it with a span for each time unit
// <span id="days1">05</span>D :<span id="hours1">05</span>H : <span id="minutes1">52</span>M : <span id="seconds1">32</span>
// like that
