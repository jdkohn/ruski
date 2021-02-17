import React from "react";
import NavBar from "./NavBar";

export default function HomeScreen({
  viewPlayerStats,
  viewTeamStats,
  viewGames,
  goToSheet,
  setupGame,
}) {
  return (
    <>
      <NavBar />
      <button onClick={viewPlayerStats}>View Player Stats</button>
      <button onClick={viewTeamStats}>View Team Stats</button>
      <button onClick={viewGames}>View Games</button>
      <button onClick={goToSheet}>Bracket</button>
      <button onClick={setupGame}>Start Game</button>
    </>
  );
}
