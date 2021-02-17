import React from "react";

export default class NameButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { color: this.props.player.activated ? "green" : "grey" };
    this.activate = this.activate.bind(this);
  }

  render() {
    return (
      <div
        className="NameButton"
        style={{ backgroundColor: this.state.color }}
        onClick={this.activate}
      >
        <h3>{this.props.player.name}</h3>
      </div>
    );
  }

  activate(e) {
    if (this.props.player.activated === false) {
      this.props.player.activated = true;
      this.setState({ color: "green" });
    } else {
      this.props.player.activated = false;
      this.setState({ color: "grey" });
    }
  }
}
