$(document).ready(function () {
    // Variables for game status, score, and settings
    let isGameRunning = false;
    let score = 0;
    let difficulty = 'medium'; // Default game difficulty
    let gameSpeed = 500; // Default game speed

    // Start the game when the Start button is clicked
    $('#start-game').click(function () {
        isGameRunning = true;
        score = 0; // Reset score
        $('#score').text(score); // Update score display
        $('#animated-object').show(); // Show the animated object
        moveObject(); // Start moving the object
    });

    // Click event on the animated object (game object)
    $('#animated-object').click(function () {
        if (isGameRunning) {
            score++;
            $('#score').text(score); // Update score display
            moveObject(); // Move object to new position
            playSoundEffect(); // Play sound when object is clicked (Step 6)
        }
    });

    // Move the object to a random location in the game area with animations
    function moveObject() {
        const gameAreaWidth = $('#game-area').width();
        const gameAreaHeight = $('#game-area').height();

        const newX = Math.floor(Math.random() * (gameAreaWidth - 50));
        const newY = Math.floor(Math.random() * (gameAreaHeight - 50));

        // Animate object movement using bounce and easing effects
        $('#animated-object').animate({
            left: newX,
            top: newY
        }, {
            duration: gameSpeed,    // Duration based on game speed
            easing: 'swing',        // Smoother animation effect
            step: function () {
                // Scale and color change during animation (Step 5 advanced animation)
                $(this).css({
                    transform: 'scale(1.2)',
                    backgroundColor: getRandomColor() // Change color dynamically
                });
            },
            complete: function () {
                // Reset scale and color after animation completes
                $(this).css({
                    transform: 'scale(1)',
                    backgroundColor: '#ff0000' // Default red color
                });
            }
        });
    }

    // Stop the game when the Stop button is clicked
    $('#stop-game').click(function () {
        isGameRunning = false;
        $('#animated-object').hide(); // Hide the object when the game stops
    });

    // Function to generate a random color for object (Step 5 enhancement)
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Play sound effect when object is clicked (Step 6 Sound Feedback)
    function playSoundEffect() {
        const sound = new Audio('click-sound.mp3'); // Make sure to add your sound file
        sound.play();
    }

    // Admin Controls: Restart Game (Step 7)
    $('#restart-game').click(function () {
        isGameRunning = true;
        score = 0; // Reset score
        $('#score').text(score); // Reset score display
        $('#animated-object').show(); // Show the object again
        moveObject(); // Start moving the object again
    });

    // Admin Controls: Clear Scores (Step 7)
    $('#clear-scores').click(function () {
        score = 0; // Clear score
        $('#score').text(score); // Reset score display
    });

    // Admin Controls: Change Game Theme (Step 7)
    $('#change-theme').click(function () {
        const newBackgroundColor = getRandomColor();
        $('#game-area').css('background-color', newBackgroundColor); // Change background color of game area
    });

    // Difficulty and Game Speed Configuration (Step 6)
    $('#difficulty-settings').on('change', function () {
        difficulty = $(this).val(); // Update difficulty based on user selection

        // Adjust game speed based on difficulty
        if (difficulty === 'easy') {
            gameSpeed = 700;
        } else if (difficulty === 'medium') {
            gameSpeed = 500;
        } else if (difficulty === 'hard') {
            gameSpeed = 300;
        }
    });
});