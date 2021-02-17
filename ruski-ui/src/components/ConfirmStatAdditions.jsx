import React from "react";

export default class ConfirmStatAdditions extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="ConfirmStatAdditions">
        <div>
          <p>For players:</p>
          {this.props.active_players.map(function (player, i) {
            return <p key={i}>{player.name}</p>;
          })}
          <p>Add stats:</p>
          {this.props.active_stats.map(function (stat, i) {
            return <p key={i}>{stat.DisplayName}</p>;
          })}
        </div>
      </div>
    );
  }
}
