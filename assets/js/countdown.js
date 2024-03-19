var timers = document.querySelectorAll(".countdown");

timers.forEach(timer => {

    var offerTime = timer.getAttribute('data-value');


    var countDownDate = new Date(offerTime).getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        var seconds = Math.floor((distance % (1000 * 60)) / 1000);


        timer.innerHTML = "<span class='timerInd'> " + days + "<small> days</small>" +"</span>" + "<span class='timerInd'> " + hours + "<small> hours</small>" +"</span>" +  "<span class='timerInd'> " + minutes + "<small> min</small>" + "</span> "  + "<span class='timerInd'> " + seconds + "<small> sec</small>" + "</span> ";


        if (distance < 0) {

            clearInterval(x);


            timer.innerHTML = "<p class='expiredClass'>Deal Expired</p>";

        }

    }, 1000);

})