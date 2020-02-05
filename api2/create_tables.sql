CREATE TABLE games (
  game_id int(11) NOT NULL AUTO_INCREMENT,
  home_team int(11) DEFAULT NULL,
  away_team int(11) DEFAULT NULL,
  date DATE DEFAULT NULL,
  tournament tinyint(1) DEFAULT NULL,
  home_cups int(11) DEFAULT 10,
  away_cups int(11) DEFAULT 10,
  PRIMARY KEY (game_id),
  UNIQUE KEY (home_team, away_team, date)
);

CREATE TABLE players (
  player_id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL UNIQUE,
  PRIMARY KEY (player_id)
);

CREATE TABLE statline (
  statline_id int(11) NOT NULL AUTO_INCREMENT,
  player_id int(11) NOT NULL,
  game_id int(11) NOT NULL,
  home_game tinyint(1) DEFAULT NULL,
  shots int(11) DEFAULT 0,
  makes int(11) DEFAULT 0,
  ginobs int(11) DEFAULT 0,
  made_ginobs int(11) DEFAULT 0,
  voms int(11) DEFAULT 0,
  forced_voms int(11) DEFAULT 0,
  redemption_shots int(11) DEFAULT 0,
  redemption_makes int(11) DEFAULT 0,
  forced_ots int(11) DEFAULT 0,
  shots_defended int(11) DEFAULT 0,
  cups_knocked_over int(11) DEFAULT 0,
  splash_outs int(11) DEFAULT 0,
  trifectas int(11) DEFAULT 0,
  difectas int(11) DEFAULT 0,
  ot_shots int(11) DEFAULT 0,
  ot_makes int(11) DEFAULT 0,
  one_cup_on_the_table_makes int(11) DEFAULT 0,
  one_cup_on_the_table_shots int(11) DEFAULT 0,
  PRIMARY KEY (statline_id),
  UNIQUE KEY (player_id, game_id)
);

CREATE TABLE intangibles (
  player_id int(11) NOT NULL,
  republican tinyint(1) DEFAULT NULL,
  dick_length float DEFAULT NULL,
  yes tinyint(1) DEFAULT NULL,
  circumcised tinyint(1) DEFAULT NULL,
  PRIMARY KEY (player_id)
);

CREATE TABLE teams (
  team_id int(11) NOT NULL AUTO_INCREMENT,
  player1 int(11) NOT NULL,
  player2 int(11) NOT NULL,
  PRIMARY KEY (team_id),
  UNIQUE KEY team (player1, player2)
);