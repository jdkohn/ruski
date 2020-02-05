# API Documentation

### How to send a GET request

After the url `guy.com/example/api/file.php` add a question mark and the paramaters like this:

`guy.com/example/api/file.php?test=true&guy=yes`

This would have GET paramaters 'test' with value true and 'guy' with value yes.

### addplayer.php

Sends a request with the the paramater `name`. If a player with that name does not already exist, it will create a new row in the `players` table and return that player's id number.

### addteam.php

Sends a request with the the paramaters `player1` and `player2`. These paramaters are both player_id numbers. If a team with those players does not already exist, it will create a new row in the `teams` table and return that team's id number.

### addgame.php

Sends a request with the paramaters `home`, `away`, and `tournament`. `home` is the id number of the home team (higher seed) and `away` is the id number of the away team. `tournament` is an indicator for if the game is a tournament game (0 for no, 1 for yes). If a game between those two teams on the same date has not already been created, it will insert a row into the `games` table and return the id number for the new game.

After this, if a new game is created, one row for each player in the game is inserted into the `statline` table.

### updatestats.php

This should be called during the game to udpate stats for that game. You must include `game_id` and `player_id` in the query string. After that, paramaters should be the names of columns which need to be updated with their current values.

Example: player with `player_id=4` is in a game with `game_id=12` and currently has 2 makes in 5 shots. Player 4 makes his next shot. The request made should have the query string:

`?player_id=4&game_id=12&makes=3&shots=6`
