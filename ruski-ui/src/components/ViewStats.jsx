import React from "react";
import axios from "axios";

import { createViewableStatsDictionary } from "./StatUtils";

const viewable_stats = createViewableStatsDictionary();

export default class ViewStats extends React.Component {
  constructor(props) {
    super(props);

    this.getStats = this.getStats.bind(this);

    this.results = [];
    this.stat = "";
    this.level = props.level;

    this.setState({ guy: 1 });
    this.stats = [];

    this.player_map = props.player_map;
    this.team_map = props.team_map;
  }

  getStats() {
    var id_col = "player_id";
    var map_guy = this.player_map;
    if (this.props.level === "team") {
      var id_col = "team_id";
      var map_guy = this.team_map;
    }

    var self = this;
    axios
      .get(
        "http://www.durhamruski.club/api/getstats.php?level=" +
          this.props.level +
          "&stat=" +
          this.stat.value
      )
      .then(function (response) {
        self.stats = [];
        response.data.forEach(function (x) {
          if (!map_guy[x[id_col]].includes("Test")) {
            self.stats.push({
              value: x[self.stat.value],
              name: map_guy[x[id_col]],
            });
          }
        });
        self.setState({ guy: 2 });
      });
  }

  render() {
    return (
      <div className="ViewStats">
        <select ref={(c) => (this.stat = c)}>
          {viewable_stats.map(function (stat, i) {
            return (
              <option key={i} value={stat.DBName}>
                {stat.DisplayName}
              </option>
            );
          })}
        </select>
        <button onClick={this.getStats}>Go</button>

        <table>
          <tbody>
            {this.stats.map(function (stat, i) {
              return (
                <tr key={i}>
                  <td>{stat.name}</td>
                  <td>{stat.value}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    );
  }
}
