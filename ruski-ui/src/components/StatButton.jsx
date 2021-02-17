import React from "react";

export default class StatButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { color: this.props.stat.activated ? "green" : "grey" };

    this.activate = this.activate.bind(this);
  }

  render() {
    return (
      <div
        className="StatButton"
        style={{ backgroundColor: this.state.color }}
        onClick={this.activate}
      >
        <h3>{this.props.stat.DisplayName}</h3>
      </div>
    );
  }

  activate(e) {
    var self = this;
    if (this.props.stat.activated === false) {
      this.props.stat.activated = true;
      // autoActivate(function(x) {
      self.setState({ color: "green" });
      // });
    } else {
      this.props.stat.activated = false;
      // autoActivate(function(x) {
      self.setState({ color: "grey" });
      // });
    }
  }
}
