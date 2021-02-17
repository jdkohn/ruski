import React from "react";
import "./App.css";
import axios from "axios";

import Button from "react-bootstrap/Button";

import StatCollection from "./components/StatCollection";
import ViewStats from "./components/ViewStats";
import { createStatDictionary } from "./components/StatUtils";
import ConfirmStatAdditions from "./components/ConfirmStatAdditions";
import HomeScreen from "./components/HomeScreen";

// the big wrapper, basically the main class
class BigWrapGuy extends React.Component {
  constructor(props) {
    super(props);
    this.state = { current_state: "validate" };

    // bind methods
    this.goToCollection = this.goToCollection.bind(this);
    this.confirm = this.confirm.bind(this);
    this.deny = this.deny.bind(this);
    this.validate = this.validate.bind(this);
    this.startGame = this.startGame.bind(this);
    this.homeGuyToGuy = this.homeGuyToGuy.bind(this);
    this.awayGuyToGuy = this.awayGuyToGuy.bind(this);
    this.setupGame = this.setupGame.bind(this);
    this.viewGames = this.viewGames.bind(this);
    this.viewPlayerStats = this.viewPlayerStats.bind(this);
    this.viewTeamStats = this.viewTeamStats.bind(this);
    this.goToHome = this.goToHome.bind(this);

    // set variables
    this.password = "";
    this.home_team = 0;
    this.away_team = 0;
    this.game_id = 0;

    // this.teams = getPlayersAndTeams();
  }

  // check if password entered was correct
  validate() {
    console.log(this.password.value);
    if (this.password.value === "guy" || this.password.value === "Guy") {
      this.setState({ current_state: "home_screen" });
    }
  }

  // start game
  startGame() {
    var home_team_id = this.home_team.value;
    var away_team_id = this.away_team.value;
    var self = this;

    if (this.home_team.value !== this.away_team.value) {
      createGame(
        this.home_team.value,
        this.away_team.value,
        1,
        function (response) {
          self.game_id = response.data.game.id;

          console.log(self.game_id);

          players = [];
          // get players in the game
          teams.forEach(function (team) {
            if (
              team.team_id === home_team_id ||
              team.team_id === away_team_id
            ) {
              players.push({
                name: team.player1_name,
                id: team.player1_id,
              });
              players.push({
                name: team.player2_name,
                id: team.player2_id,
              });
            }
          });

          self.setState({ current_state: "guy_to_guy" });
        }
      );
    }
  }

  udpateGuyToGuy(team) {
    var self = this;
    axios
      .get(
        "http://www.durhamruski.club/api/updateguytoguy.php?team=" +
          team +
          "&game_id=" +
          this.game_id
      )
      .then(function (response) {
        self.setState({ current_state: "collection" });
      });
  }

  homeGuyToGuy() {
    this.udpateGuyToGuy(1);
  }

  awayGuyToGuy() {
    this.udpateGuyToGuy(0);
  }

  // done adding stats, go to confirmation
  goToCollection() {
    addStats();
    this.setState({ current_state: "confirmation" });
  }

  // confirm the stats entered were correct
  confirm() {
    var s = "";
    var g_id = this.game_id;
    active_players.forEach(function (player, i) {
      var s = "?player_id=" + player.id + "&game_id=" + g_id + "&";

      active_stats.forEach(function (stat, i) {
        s = s + stat.DBName + "=" + 1 + "&";
      });

      axios.get("http://www.durhamruski.club/api/addstats.php" + s);
    });

    clearStats();
    this.setState({ current_state: "collection" });
  }

  // stats entered were not correct, go back
  deny() {
    this.setState({ current_state: "collection" });
  }

  viewPlayerStats() {
    this.setState({ current_state: "player_stats" });
  }

  viewTeamStats() {
    this.setState({ current_state: "team_stats" });
  }

  viewGames() {
    this.setState({ current_state: "games" });
  }

  setupGame() {
    this.setState({ current_state: "choose_teams" });
  }

  goToHome() {
    this.setState({ current_state: "home_screen" });
  }

  goToSheet() {
    window.open(
      "https://docs.google.com/spreadsheets/d/1ycFPGnI_sf4Nbgeker6p4CWrXgT7bqcRbcCAP29A_WU/edit?usp=sharing",
      "_blank"
    );
  }

  handleNameOnChange(e) {
    console.log(e);
  }

  render() {
    // validation screen
    if (this.state.current_state === "validate") {
      return (
        <div>
          <input placeholder="Password" ref={(c) => (this.password = c)} />
          <Button onClick={this.validate} className="m-2">
            Submit
          </Button>
        </div>
      );
      // choose the teams which are playing
    } else if (this.state.current_state === "home_screen") {
      return (
        <HomeScreen
          viewPlayerStats={this.viewPlayerStats}
          viewTeamStats={this.viewTeamStats}
          viewGames={this.viewGames}
          goToSheet={this.goToSheet}
          setupGame={this.setupGame}
        />
      );
      // view stats
    } else if (this.state.current_state === "player_stats") {
      return (
        <div>
          <h3>Player Stats</h3>
          <ViewStats
            level="player"
            player_map={player_map}
            team_map={team_map}
          ></ViewStats>
          <button onClick={this.viewTeamStats}>View Team Stats</button>
          <button onClick={this.goToHome}>Home</button>
        </div>
      );
      // choose teams
    } else if (this.state.current_state === "team_stats") {
      return (
        <div>
          <h3>Team Stats</h3>
          <ViewStats
            level="team"
            player_map={player_map}
            team_map={team_map}
          ></ViewStats>
          <button onClick={this.viewPlayerStats}>View Player Stats</button>
          <button onClick={this.goToHome}>Home</button>
        </div>
      );
      // choose teams
    } else if (this.state.current_state === "games") {
      return (
        <div>
          <h3>This doesn't work yet</h3>
          <button onClick={this.goToHome}>Home</button>
        </div>
      );
      // choose teams
    } else if (this.state.current_state === "choose_teams") {
      return (
        <div>
          <table style={{ width: "100%" }}>
            <tbody>
              <tr style={{ width: "100%" }}>
                <td style={{ width: "50%" }}>Home Team</td>
                <td style={{ width: "50%" }}>Away Team</td>
              </tr>
              <tr>
                <td>
                  <select ref={(c) => (this.home_team = c)}>
                    {teams.map(function (team, i) {
                      return (
                        <option key={i} value={team.team_id}>
                          {team.player1_name} & {team.player2_name}
                        </option>
                      );
                    })}
                  </select>
                </td>
                <td>
                  <select ref={(c) => (this.away_team = c)}>
                    {teams.map(function (team, i) {
                      return (
                        <option key={i} value={team.team_id}>
                          {team.player1_name} & {team.player2_name}
                        </option>
                      );
                    })}
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <button class="DoneButton" onClick={this.startGame}>
            Start Game
          </button>
        </div>
      );
      // select which team won guy to guy
    } else if (this.state.current_state === "guy_to_guy") {
      return (
        <div>
          <p> Which team won guy to guy</p>
          <button onClick={this.homeGuyToGuy}>Home Team</button>
          <button onClick={this.awayGuyToGuy}>Away Team</button>
        </div>
      );
      // collection state
    } else if (this.state.current_state === "collection") {
      return (
        <div>
          <StatCollection
            updateState={this.updateState}
            players={players}
            stats={stats}
          ></StatCollection>
          <button className="DoneButton" onClick={this.goToCollection}>
            <b>Add Stats</b>
          </button>
        </div>
      );
      // confirmation state
    } else if (this.state.current_state === "confirmation") {
      return (
        <div>
          <ConfirmStatAdditions
            active_stats={active_stats}
            active_players={active_players}
          ></ConfirmStatAdditions>
          <button onClick={this.confirm}>Confirm</button>
          <button onClick={this.deny}>Deny</button>
        </div>
      );
    }
  }
}

var team_map = {};
var player_map = {};

//////// API CALLS /////////
function getPlayersAndTeams(callback) {
  axios
    .get("http://www.durhamruski.club/api/getplayersteams.php")
    .then(function (response) {
      // console.log(response);
      teams = response.data;

      teams.forEach(function (team) {
        team_map[team.team_id] = team.player1_name + " & " + team.player2_name;
        player_map[team.player1_id] = team.player1_name;
        player_map[team.player2_id] = team.player2_name;
      });
    });
}

function createGame(home_team, away_team, tournament, callback) {
  var get_str =
    "http://www.durhamruski.club/api/addgame.php?home=" +
    home_team +
    "&away=" +
    away_team +
    "&tournament=" +
    tournament;
  axios.get(get_str).then((response) => callback(response));
}

//////// UPDATING STATS ///////////

var activation_rules = {
  shots: [],
  makes: ["shots"],
  ginobs: ["shots"],
  made_ginobs: ["shots", "makes"],
  voms: [],
  forced_voms: [],
  redemption_shots: ["shots"],
  redemption_makes: ["redemption_shots", "shots", "makes"],
  forced_ots: [],
  shots_defended: [],
  cups_knocked_over: [],
  splash_outs: ["shots"],
  trifectas: ["shots"],
  difectas: ["shots"],
  ot_shots: ["shots"],
  ot_makes: ["ot_shots", "shots", "makes"],
  one_cup_on_the_table_shots: ["shots"],
  one_cup_on_the_table_makes: ["one_cup_on_the_table_shots", "shots", "makes"],
  balls_back: [],
};

function autoActivate(callback) {
  var to_activate = [];
  stats.forEach(function (stat) {
    if (stat.activated) {
      console.log(to_activate);
      console.log(activation_rules);
      console.log(activation_rules[stat.DBName]);
      to_activate = to_activate.concat(activation_rules[stat.DBName]);
    }
  });

  stats.forEach(function (stat) {
    if (to_activate.includes(stat.DBName)) {
      stat.activated = true;
    }
  });

  callback(true);
}

function addStats() {
  active_stats = [];
  stats.forEach(function (stat) {
    if (stat.activated) {
      active_stats.push(stat);
    }
  });

  active_players = [];
  players.forEach(function (player) {
    if (player.activated) {
      active_players.push(player);
    }
  });
}

function clearStats() {
  stats.forEach(function (stat) {
    stat.activated = false;
  });

  players.forEach(function (player) {
    player.activated = false;
  });
}

// GLOBAL VARIABLES FOR GAMEPLAY

const stats = createStatDictionary();

var players = [
  { name: "A", id: 1, activated: false },
  { name: "B", id: 2, activated: false },
  { name: "C", id: 3, activated: false },
  { name: "D", id: 4, activated: false },
];
// var teams = [{"team_id":"1","player1_id":"1","player1_name":"Jake Kohn","player2_id":"2","player2_name":"Daniel Gardner"},{"team_id":"2","player1_id":"3","player1_name":"Kyle Shutkind","player2_id":"4","player2_name":"Nick Agoglia"}]
var teams = [];
getPlayersAndTeams();

var active_stats = [];
var active_players = [];

function App() {
  return <BigWrapGuy></BigWrapGuy>;
}

export default App;
