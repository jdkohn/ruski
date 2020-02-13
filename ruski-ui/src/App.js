import React from 'react';
import logo from './logo.svg';
import './App.css';
import axios from 'axios';

class StatButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { 'color': this.props.stat.activated ? 'green' : 'grey' };

    this.activate = this.activate.bind(this);
  }

  render() {
    return (
      <div className="StatButton" style={{ 'backgroundColor' : this.state.color }} onClick={this.activate}>
        <h3>{this.props.stat.DisplayName}</h3>
      </div>
    );
  }

  activate(e) {
    if (this.props.stat.activated == false) {
      this.props.stat.activated = true;
      this.setState({'color': 'green'})
    } else {
      this.props.stat.activated = false;
      this.setState({'color': 'grey'})
    }
  }
}

class NameButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { 'color': this.props.player.activated ? 'green' : 'grey' };
    this.activate = this.activate.bind(this);
  }

  render() {
    return (
      <div className="NameButton" style={{ 'backgroundColor' : this.state.color }} onClick={this.activate}>
        <h3>{this.props.player.name}</h3>
      </div>
    );
  }

  activate(e) {
    if (this.props.player.activated == false) {
      this.props.player.activated = true;
      this.setState({'color': 'green'})
    } else {
      this.props.player.activated = false;
      this.setState({'color': 'grey'})
    }
  }
}

class StatCollection extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="App">

        <h2> Players </h2>
        {players.map(function(player, i) {
          return <NameButton key={i} player={player}></NameButton>
        })}

        <hr/>
        <hr/>

        <h2> Stats </h2>
        {stats.map(function(stat, i) {
          return <StatButton key={i} stat={stat}></StatButton>
        })}

        <hr/>
        <hr/>
     
      </div>
    )
  }
}

class ConfirmStatAdditions extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="ConfirmStatAdditions">
        <div>
          <p>For players:</p>
          {this.props.active_players.map(function(player, i) {
            return <p key={i}>{player.name}</p>
          })}
          <p>Add stats:</p>
          {this.props.active_stats.map(function(stat, i) {
            return <p key={i}>{stat.DisplayName}</p>
          })}
        </div>
      </div>
    );
  }
}

class BigWrapGuy extends React.Component {
  constructor(props) {
    super(props);
    this.state = {'current_state': 'collection'};

    this.goToCollection = this.goToCollection.bind(this);
    this.confirm = this.confirm.bind(this);
    this.deny = this.deny.bind(this)
  }

  updateState(new_state) {
    console.log('!');
    console.log(new_state);
    
  }

  goToCollection() {
    addStats();
    this.setState({'current_state': 'confirmation'});
  }
  
  confirm() {
    var str = '?';

    active_players.forEach(function(player, i) {
      str = str + 'p' + parseInt(i) + '=' + player.id + '&';
    });

    active_stats.forEach(function(stat, i) {
      str = str + stat.DBName + '=' + 1 + '&';
    });

    axios.get('http://www.durhamruski.club/api/addstats.php' + str)
      .then(function(response) {

        this.setState({'current_state': 'collection'});

      });
  }

  deny() {
    console.log('!!');
    this.setState({'current_state': 'collection'});
  }

  render() {
    if (this.state.current_state == 'collection') {
      return ( 
        <div>
          <StatCollection updateState={this.updateState}></StatCollection>
          <button className="DoneButton" onClick={this.goToCollection}><b>Add Stats</b></button>
        </div>
      )
    } else if (this.state.current_state == 'confirmation') {
      return ( 
        <div>
          <ConfirmStatAdditions active_stats={active_stats} active_players={active_players}></ConfirmStatAdditions>
          <button onClick={this.confirm}>Confirm</button>
          <button onClick={this.deny}>Deny</button>
        </div>
      )
    }
  }
}

function getPlayersAndTeams(callback) {
  axios.get('http://www.durhamruski.club/api/getplayersteams.php')
    .then(response => callback(response))
}

function createGame(team1, team2, tournament, callback) {
  axios.get('http://www.durhamruski.club/api/creategame.php?team1=' + team1 + '&team2=' + team2 + '&tournament=1')
    .then(response => callback(response))
}

function addStats() {
  active_stats = [];
  stats.forEach(function(stat) {
    if (stat.activated) {
      active_stats.push(stat);
    }
  });

  active_players = [];
  players.forEach(function(player) {
    if (player.activated) {
      active_players.push(player);
    }
  });
}

function clearStats() {
  stats.forEach(function(stat) {
    stat.activated = false;
  });

  players.forEach(function(player) {
    player.activated = false;
  });
}

function createStatDictionary() {
  var tmp = [];
  tmp.push(createStatDictionaryEntry('Shot', 'shots'));
  tmp.push(createStatDictionaryEntry('Made Cup', 'makes'));
  tmp.push(createStatDictionaryEntry('Guy', 'ginobs'));
  tmp.push(createStatDictionaryEntry('Made Guy', 'made_ginobs'));
  tmp.push(createStatDictionaryEntry('Vom', 'voms'));
  tmp.push(createStatDictionaryEntry('Forced Vom', 'forced_voms'));
  tmp.push(createStatDictionaryEntry('Redemption Shot', 'redemption_shots'));
  tmp.push(createStatDictionaryEntry('Made Redemption Shot', 'redemption_makes'));
  tmp.push(createStatDictionaryEntry('Forced OT', 'forced_ots'));
  tmp.push(createStatDictionaryEntry('Defended Shot', 'shots_defended'));
  tmp.push(createStatDictionaryEntry('Knocked Cup Over', 'cups_knocked_over'));
  tmp.push(createStatDictionaryEntry('Splash Out', 'splash_outs'));
  tmp.push(createStatDictionaryEntry('Trifecta', 'trifectas'));
  tmp.push(createStatDictionaryEntry('Difecta', 'difectas'));
  tmp.push(createStatDictionaryEntry('OT Shot', 'ot_shots'));
  tmp.push(createStatDictionaryEntry('OT Made Shot', 'ot_makes'));
  tmp.push(createStatDictionaryEntry('One Cup On the Table Make', 'one_cup_on_the_table_makes'));
  tmp.push(createStatDictionaryEntry('One Cup On the Table Shot', 'one_cup_on_the_table_shots'));
  tmp.push(createStatDictionaryEntry('Balls Back', 'balls_back'));

  return tmp;
}

function createStatDictionaryEntry(display, db) {
  return {'DisplayName': display, 'DBName': db, 'activated': false};
}

const stats = createStatDictionary();
var players = [{'name': 'A', 'id': 1, 'activated': false}, {'name': 'B', 'id': 2, 'activated': false}, {'name': 'C', 'id': 3, 'activated': false}, {'name': 'D', 'id': 4, 'activated': false}];
var globals = {'state': 'collection'};

var active_stats = [];
var active_players = [];

function App() {
  return ( <BigWrapGuy></BigWrapGuy> )
}

export default App;
