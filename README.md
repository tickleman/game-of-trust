 # The Game Of Trust

A tiny Prisoner's Dilemma game to experiment, based on the 'Evolution Of Trust' game by Nicky Case.

## Play

You will need git and php 7.1+ cli installed to play with it.

    git clone git@github.com:tickleman/game-of-trust
    cd game-of-trust
    # Choose two opponent strategies into folder Strategies, then :
    php index.php Copycat Grudger
    # You can fix the number of rounds (10 is the default)
    php index.php Random Simpleton 10
    # You can fix the winner's earned score (3 is the default)
    php index.php Copycat Cooperator 10 3
    # You can also play as human
    php index.php Copykitten Human
