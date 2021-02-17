import React from "react";
import StatButton from "./StatButton";
import NameButton from "./NameButton";

export default class StatCollection extends React.Component {
  constructor(props) {
    super(props);
    this.players = props.players;
    this.stas = props.stats;
  }

  render() {
    return (
      <div className="App">
        <h2> Players </h2>
        {this.players.map(function (player, i) {
          return <NameButton key={i} player={player}></NameButton>;
        })}

        <hr />
        <hr />

        <h2> Stats </h2>
        {this.stats.map(function (stat, i) {
          return <StatButton key={i} stat={stat}></StatButton>;
        })}

        <hr />
        <hr />
      </div>
    );
  }
}
