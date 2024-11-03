$(document).ready(function () {
    var width = screen.width - 100;
    var height = screen.height - 200;

    function generateRandomLetter() {
        // Generate a random letter between A-Z
        var letterCode = Math.floor(Math.random() * (90 - 65 + 1)) + 65; // Random number between 65 and 90
        return String.fromCharCode(letterCode);
    }

    function getRandomColor() {
        // Generate a random color
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function createBubble() {
        var letter = generateRandomLetter();
        var bubble = $('<div class="bubble">' + letter + '</div>');

        // Set random position
        var xPos = Math.floor(Math.random() * width);
        var yPos = Math.floor(Math.random() * height);
        bubble.css({
            left: xPos + 'px',
            top: yPos + 'px',
            backgroundColor: getRandomColor()
        });

        $('body').append(bubble);

        // Remove bubble after 2 seconds
        setTimeout(function () {
            bubble.remove();
        }, 2000);
    }

    // Create a bubble every second
    setInterval(createBubble, 1000);

    // Key press event
    $(document).keypress(function (event) {
        var keyPressed = String.fromCharCode(event.which).toUpperCase(); // Convert key code to character

        $('.bubble').each(function () {
            if ($(this).text() === keyPressed) {
                $(this).remove(); // Remove bubble if it matches the pressed key
                alert("You hit the letter: " + keyPressed); // Alert the hit letter
            }
        });
    });
});
