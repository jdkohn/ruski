import React from "react";

export default class FantasyStats extends React.Compnent {
  constructor(props) {
    super(props);

    this.setState({ guy: 1 });
    this.all_stats = [];

    this.multipliers = {
      makes: 1.8,
      shots: -0.2,
      trifecta: 5,
      voms: 2.5,
      cups_defended: 0.7,
      cups_knocked_over: -2,
      difectas: 20,
    };

    var self = this;

    axios
      .get("http://www.durhamruski.club/api/getstats?level=player&stat=all")
      .then(function (response) {
        response.data.forEach(function (x) {
          if (!player_map[x["player_id"]].includes("Test")) {
            self.multipliers.entries(driversCounter).forEach(([key, value]) => {
              self.all_stats.push({
                name: player_map[x["player_id"]],
                stat: key,
                multiplier: value,
                value: x[key],
              });
            });
          }
        });
      });
  }

  render() {
    return (
      <>
        <h3>Fantasy Stats</h3>

        <table>
          <tbody>
            {this.all_stats.map(function (stat, i) {
              return (
                <tr key={i}>
                  <td>{stat.name}</td>
                  <td>{stat.multiplier}</td>
                  <td>{stat.value * stat.multiplier}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </>
    );
  }
}
